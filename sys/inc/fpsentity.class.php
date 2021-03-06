<?php/*---------------------------------------------\|											   || @Author:       Andrey Brykin (Drunya)        || @Version:      1.0                           || @Project:      CMS                           || @Package       AtomX CMS                     || @subpackege    FpsEntity class               || @copyright     ©Andrey Brykin 2010-2012      || @last mod      2012/02/27                    ||----------------------------------------------||											   || any partial or not partial extension         || CMS AtomX,without the consent of the         || author, is illegal                           ||----------------------------------------------|| Любое распространение                        || CMS AtomX или ее частей,                     || без согласия автора, является не законным    |\---------------------------------------------*/class FpsEntity {	//protected $add_fields = array();		public function __construct($params = array())	{		if (!empty($params) && is_array($params)) {			foreach ($params as $k => $value) {				$funcName = 'set' . ucfirst($k);				$this->$funcName($value);			}		}	}    public function __invoke($params = array())    {        $this->__construct($params);        return $this;    }		public function __call($method, $params)	{		if (false !== strpos($method, 'set')) {			$name = str_replace('set', '', $method);			$name = strtolower($name);			$this->$name = $params[0];					} else if (false !== strpos($method, 'get')) {			$name = str_replace('get', '', $method);			$name = strtolower($name);			return (isset($this->$name)) 				? /*($name === 'id') ? intval($this->$name) : */$this->$name				: null;		}		return $this;	}    protected function checkProperty($var)    {        //return (null === $var) ? false : true;		if (is_object($var)) return true;        return (!isset($this->{$var}) || $this->{$var} === null) ? false : true;    }	public function asArray()	{		$args = get_object_vars($this);		$args = array_map(function($n){			if (is_object($n) && is_callable(array($n, 'asArray'))) {				return $n->asArray();			}			return $n;		}, $args);		return $args;	}		protected function save()	{		$args = func_get_args();		$table = (string)$args[0];		$params = (array)$args[1];				$Register = Register::getInstance();				$self_id = $Register['DB']->save($table, $params);		if (!$this->id) $this->id = intval($self_id);		return $this->id;	}}
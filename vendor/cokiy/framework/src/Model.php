<?php
namespace cokiy\framework;
class Model
{
	protected $host;
	protected $user;
	protected $password;
	protected $dbname;
	protected $charset;
	protected $prefix;
	protected $link;
	public $sql;
	protected $cacheDir;
	public $cacheField;
	public $table = '';

	public $options = [
					'fields' => '*',
					'table' => '',
					'where' => '',
					'groupby' => '',
					'having' => '',
					'orderby' => '',
					'limit' => '',
					'values' => ''
				];

	public function __construct(array $config)
	{
		$this->host = $config['DB_HOST'];
		$this->user = $config['DB_USER'];
		$this->password = $config['DB_PASSWORD'];
		$this->dbname = $config['DB_NAME'];
		$this->charset = $config['DB_CHARSET'];
		$this->prefix = $config['DB_PREFIX'];
		$this->cacheDir = $config['DB_CACHE'];
		$this->table = $this->connect();
		$this->cacheDir = $config['DB_CACHE'];
		if (!$this->checkDir($this->cacheDir)) {
			exit('缓存目录不存在.');
		}
		$this->table = $this->prefix . $this->getTable();
		$this->cacheField = $this->getCacheFields();
		$this->options = $this->initOptions();
	}

	public function getTable()
	{
		$className= get_class($this);
		if (strpos($className,'\\') !== false) {
			$className = substr($className, strrpos($className,'\\')+1);
		} else {
			$className = substr($className, strrpos($className,'\\'));
		}
		$className = substr($className,0,-5);
		return lcfirst($className);
	}

	/**
	 * [getCacheFields 得到表里面所有字段名]
	 * @author cokiy
	 * @version [1.0]
	 * @date    2017-06-14
	 * @return  [type]     [返回包含所有字段名的数组]
	 */
	public function getCacheFields()
	{
		$path = rtrim($this->cacheDir,'/') . '/' . $this->table . '.php';
		if (file_exists($path)) {
			return include $path;
		}
		$sql = 'desc ' . $this->table;
		$data = $this->query($sql,MYSQLI_BOTH);
		// var_dump($data);
		foreach ($data as $key => $value) {
			if ('PRI' == $value['Key']) {
				$fields['PRI'] = $value['Field'];
			}
			$fields[] = $value['Field'];
		}
		// var_dump($fields);
		$str = "<?php \n return " . var_export($fields,true) . ";?>";
		file_put_contents($path,$str);
		return include $path;
	}

	/**
	 * [initOptions 初始化sql语句所需内容，防止二次调用时冲突]
	 * @author cokiy
	 * @version [1.0]
	 * @date    2017-06-14
	 * @return  [type]     [初始内容]
	 */
	protected function initOptions()
	{
		return [
					'fields' => '*',
					'table' => $this->table,
					'where' => '',
					'groupby' => '',
					'having' => '',
					'orderby' => '',
					'limit' => '',
					'values' => ''
				];
	}

	/**
	 * [checkDir 检查目录是否存在以及是否可读可写]
	 * @author cokiy
	 * @version [1.0]
	 * @date    2017-06-13
	 * @param   [type]     $dir [目录名]
	 * @return  [type]          [创建或修改成功返回true，否则返回false]
	 */
	protected function checkDir($dir)
	{
		if (!is_dir($dir)) {
			if (!mkdir($dir,0777)) {
				return false;
			}
			return true;
		}
		if ((!is_readable($dir)) || (!is_writeable($dir))) {
			if (!chmod($dir,0777)) {
				return false;
			}
		}
		return true;
	}

	/**
	 * [connect 连接数据库]
	 * @author cokiy
	 * @version [1.0]
	 * @date    2017-06-14
	 * @return  [type]     [无，直接给$this->link赋值]
	 */
	protected function connect()
	{
		$link = mysqli_connect($this->host,$this->user,$this->password);
		if (!$link) {
			exit('连接数据库失败');
		}
		$res = mysqli_select_db($link, $this->dbname);
		if (!$res) {
			exit('选择数据库失败');
		}
		$res = mysqli_set_charset($link, $this->charset);
		if (!$res) {
			exit('设置字符集失败');
		}
		$this->link = $link;
	}

	/**
	 * [where sql语句条件]
	 * @author cokiy
	 * @version [1.0]
	 * @date    2017-06-14
	 * @param   [type]     $where [查询字段名，字符串或索引数组]
	 * @return  [type]            [返回$this,供连贯操作]
	 */
	public function where($where)
	{
		if (is_string($where)) {
			$this->options['where'] = ' where ' . $where;
		} elseif (is_array($where)) {
			$this->options['where'] = ' where ' . implode(',',$where);
		}
		return $this;
	}

	/**
	 * [groupby 结果集排序]
	 * @author cokiy
	 * @version [1.0]
	 * @date    2017-06-14
	 * @param   [type]     $groupby [排序字段名，字符串或索引数组]
	 * @return  [type]              [返回$this,供连贯操作]
	 */
	public function groupby($groupby)
	{
		if (is_string($groupby)) {
			$this->options['groupby'] = ' group by ' . $groupby;
		} elseif (is_array($groupby)) {
			$this->options['groupby'] = ' group by ' . implode(',',$groupby);
		}
		return $this;
	}

	/**
	 * [having 结果集过滤]
	 * @author cokiy
	 * @version [1.0]
	 * @date    2017-06-14
	 * @param   [type]     $having [过滤字段名，字符串或索引数组]
	 * @return  [type]             [返回$this,供连贯操作]
	 */
	public function having($having)
	{
		if (is_string($having)) {
			$this->options['having'] = ' having ' . $having;
		} elseif (is_array($having)) {
			$this->options['having'] = ' having ' . implode(',',$having);
		}
		return $this;
	}

	/**
	 * [orderby 结果集分组]
	 * @author cokiy
	 * @version [1.0]
	 * @date    2017-06-14
	 * @param   [type]     $orderby [分组字段名，字符串或索引数组]
	 * @return  [type]              [返回$this,供连贯操作]
	 */
	public function orderby($orderby)
	{
		if (is_string($orderby)) {
			$this->options['orderby'] = ' order by ' . $orderby;
		} elseif (is_array($orderby)) {
			$this->options['orderby'] = ' order by ' . implode(',',$orderby);
		}
		return $this;
	}

	/**
	 * [limit 截取结果集]
	 * @author cokiy
	 * @version [1.0]
	 * @date    2017-06-14
	 * @param   [type]     $limit [截取个数，字符串或索引数组]
	 * @return  [type]            [返回$this,供连贯操作]
	 */
	public function limit($limit)
	{
		if (is_string($limit)) {
			$this->options['limit'] = ' limit ' . $limit;
		} elseif (is_array($limit)) {
			$this->options['limit'] = ' limit ' . implode(',',$limit);
		}
		return $this;
	}

	/**
	 * [fields 获得要查找的字段]
	 * @author cokiy
	 * @version [1.0]
	 * @date    2017-06-14
	 * @param   [type]     $fields [要查找的字段名，字符串类型]
	 * @return  [type]             [$this]
	 */
	public function fields($fields)
	{
		$this->options['fields'] = $fields;
		return $this;
	}

	/**
	 * [table 多表联查方法]
	 * @author cokiy
	 * @version [1.0]
	 * @date    2017-06-20
	 * @param   string     $table [表名，可以是多个，字符串形式]
	 * @return  [type]            [返回$this,供连贯操作]
	 */
	public function table(string $table)
	{
		$tables = explode(',',$table);
		foreach ($tables as $key => $value) {
			$tbName = $this->prefix . ltrim($value,$this->prefix);
			$tables[$key] = $tbName;
		}
		$this->options['table'] = join(',',$tables);
		return $this;
	}

	/**
	 * [values 要更新的字段]
	 * @author cokiy
	 * @version [1.0]
	 * @date    2017-06-14
	 * @param   [type]     $values [要更新的内容，关联数组]
	 * @return  [type]             [返回$this,供连贯操作]
	 */
	public function updatevalues(array $values)
	{
		$values = $this->addQuote($values);
		// var_dump($values);
		$data = $this->fieldsFilter($values);
		// var_dump($data);
		$str = '';
		foreach ($values as $key => $value) {
			if (array_key_exists($key, $data)) {
				$str .= $key . '=' . $value . ',';
			}

		}
		$str = rtrim($str,',');
		$this->options['values'] = $str;
		// var_dump($this->cacheField);
		// var_dump($data);
		// $this->options['values'] = $values;
		return $this;
	}

	/**
	 * [insertvalues 插入的字段]
	 * @author cokiy
	 * @version [1.0]
	 * @date    2017-06-15
	 * @param   array      $values [插入的字段及内容，关联数组]
	 * @return  [type]             [返回$this,供连贯操作]
	 */
	public function insertvalues(array $values)
	{
		$values = $this->addQuote($values);
		$data = $this->fieldsFilter($values);
		$this->options['fields'] = implode(',',array_keys($data));
		$this->options['values'] = implode(',',array_values($data));
		return $this;
	}

	/**
	 * [fieldsFilter 过滤无效字段]
	 * @author cokiy
	 * @version [1.0]
	 * @date    2017-06-15
	 * @param   [type]     $fields [字段及内容，关联数组]
	 * @return  [type]             [返回包含有效字段及值的数组]
	 */
	protected function fieldsFilter($fields)
	{
		$data = array_unique($this->cacheField);
		$data = array_flip($data);
		$data = array_intersect_key($fields,$data);
		return $data;
	}

	/**
	 * [select 查询]
	 * @author cokiy
	 * @version [1.0]
	 * @date    2017-06-14
	 * @return  [type]     [返回结果集]
	 */
	public function select()
	{
		$sql = "select %fields% from %table% %where% %groupby% %having% %orderby% %limit%";
		$sql = str_replace(['%fields%',
							'%table%',
							'%where%',
							'%groupby%',
							'%having%',
							'%orderby%',
							'%limit%'],
						   ['fields' => $this->options['fields'],
							'table' => $this->options['table'],
							'where' => $this->options['where'],
							'groupby' => $this->options['groupby'],
							'having' => $this->options['having'],
							'orderby' => $this->options['orderby'],
							'limit' => $this->options['limit']],$sql);
		// var_dump($sql);
		return $this->query($sql,$resultType= MYSQLI_BOTH);
	}

	/**
	 * [query 查询操作时执行sql语句并返回结果集]
	 * @author cokiy
	 * @version [1.0]
	 * @date    2017-06-14
	 * @param   [type]     $sql        [sql语句]
	 * @param   [type]     $resultType [返回结果集类型]
	 * @return  [type]                 [返回结果集或false]
	 */
	protected function query($sql,$resultType= MYSQLI_BOTH)
	{
		$this->sql = $sql;
		$this->options = $this->initOptions();
		$result = mysqli_query($this->link,$sql);
		if ($result && mysqli_affected_rows($this->link) > 0) {
			// return mysqli_fetch_all($result,$resultType);
			while ($record = mysqli_fetch_assoc($result)) {
				$data[] = $record;
			}
			return $data;
		}
		return false;
	}

	/**
	 * [insert 插入数据]
	 * @author cokiy
	 * @version [1.0]
	 * @date    2017-06-14
	 * @return  [type]     [无，直接输出执行结果]
	 */
	public function insert()
	{
		$sql = "insert into %table%(%fields%) values(%values%)";
		// var_dump($fields);die;
		$sql = str_replace(['%fields%',
							'%table%',
							'%values%'],
						   ['fields' => $this->options['fields'],
							'table' => $this->options['table'],
							'values' => $this->options['values']],$sql);
		// echo $sql . '<br />';
		return $this->queryResult($sql);
	}

	/**
	 * [insert 删除数据]
	 * @author cokiy
	 * @version [1.0]
	 * @date    2017-06-14
	 * @return  [type]     [无，直接输出执行结果]
	 */
	public function delete($isforce = false)
	{
		$sql = "delete from %table% %where%";
		$sql = str_replace(['%table%',
							'%where%'],
						   ['table' => $this->options['table'],
							'where' => $this->options['where']],$sql);
		// echo $sql . '<br />';
		if (empty($this->options['where']) && !$isforce) {
			exit('检测到没有删除条件将删除所有，如果确定执行，请在delete方法中添加参数true并重新执行。');
		}
		return $this->queryResult($sql);
	}

	public function update($isforce = false)
	{
		$sql = "update %table% set %values% %where% %groupby% %limit%";
		$sql = str_replace(['%table%',
							'%values%',
							'%where%',
							'%groupby%',
							'%limit%'],
						   ['table' => $this->options['table'],
						    'values' => $this->options['values'],
							'where' => $this->options['where'],
							'groupby' => $this->options['groupby'],
							'limit' => $this->options['limit']],$sql);
		// var_dump($sql);die;
		if (empty($this->options['where']) && !$isforce) {
			exit('检测到没有更新条件将更新所有，如果确定执行，请在update方法中添加参数true并重新执行。');
		}
		return $this->queryResult($sql);
		
	}

	/**
	 * [queryResult 除查询外的sql语句执行函数]
	 * @author cokiy
	 * @version [1.0]
	 * @date    2017-06-14
	 * @param   [type]     $sql        [sql语句]
	 * @return  [type]                 [执行sql语句成功返回true，否则返回false]
	 */
	protected function queryResult($sql)
	{
		$this->sql = $sql;
		$this->options = $this->initOptions();
		$result = mysqli_query($this->link,$sql);
		if ($result) {
			return true;
		}
		return false;
	}

	protected function addQuote($values)
	{
		if (is_array($values)) {
			foreach ($values as $key => $value) {
				if (is_string($value)) {
					$values[$key] = "'$value'";
				}
			}
		}
		return $values;
	}

}


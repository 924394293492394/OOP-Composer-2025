# Магические методы (ALL IN PHP)
изучение ООП. старт 24/05/2025

Магические методы — методы, которые переопределяют действие PHP по умолчанию, когда над объектом выполняются отдельные действия.

Следующие названия методов относятся к магическим: __construct(), __destruct(), __call(), __callStatic(), __get(), __set(), __isset(), __unset(), __sleep(), __wakeup(), __serialize(), __unserialize(), __toString(), __invoke(), __set_state(), __clone() и __debugInfo()
## План изучения:
### Сериализация объектов (сохранение объекта для передачи в другое местоположение, то есть за пределы файла в котором и создавал экземпляр данного класса)
Функция serialize() возвращает строковое представление любого значения, которое может быть сохранено в PHP. Функция unserialize() может использовать эту строку для восстановления исходного значения переменной. Использование сериализации для сохранения объекта сохранит все его переменные. Методы в объекте не будут сохранены, только имя класса.

Чтобы десериализовать объект функцией unserialize(), необходимо заранее определить класс этого объекта. То есть, если есть экземпляр класса А, и он будет сериализован, будет получено его строковое представление, которое содержит значение всех переменных, содержащихся в нем. Чтобы восстановить объект из строки в другом PHP-файле, класс A должен быть определён в этом файле заранее. Это можно сделать, например, путём сохранения определения класса A в отдельном файле и подключения этого файла или вызовом функции spl_autoload_register() для автоматического подключения.

<?php
// A.php:

  class A {
      public $one = 1;

      public function show_one() {
          echo $this->one;
      }
  }

// page1.php:

  include "A.php";

  $a = new A;
  $s = serialize($a);
  // сохраняем $s где-нибудь, откуда page2.php сможет его получить.
  file_put_contents('store', $s);

// page2.php:

  // это нужно для того, чтобы функция unserialize работала правильно.
  include "A.php";

  $s = file_get_contents('store');
  $a = unserialize($s);

  // теперь можно использовать метод show_one() объекта $a.
  $a->show_one();
?>

Если в приложении сериализуются объекты, которые будут использованы в приложении позже, следуют строгой рекомендации — подключать определение класса для этого объекта во всём приложении. При невыполнении этого требования десериализация объекта пройдёт и без определения класса, но PHP назначит этому объекту класс __PHP_Incomplete_Class_Name, у которого нет методов, и сделает объект бесполезным.

Поэтому, как в примере выше, если переменная $a стала частью сессии путём добавления нового ключа в суперглобальный массив $_SESSION, нужно подключать файл A.php на всех страницах, а не только на страницах page1.php и page2.php.

Обратите внимание, что, кроме уже приведённого совета, можно подключиться к событиям сериализации и десериализации объекта через методы __sleep() и __wakeup(). В методе __sleep() можно управлять тем, какие свойства объекта будут сериализованы.

### __construct()
Класс с методом-конструктором вызовет этот метод на каждом вновь созданном объекте класса.

    public function __construct($name, $age, $hours) {
        parent::__construct($name, $age, $hours);
    }

### __destruct()
PHP вызовет деструктор, как только не останется ссылок на конкретный объект, или в другом порядке в течение завершения работы.

    function __destruct()
    {
        print "Уничтожается " . __CLASS__  . "\n";
    }

### __call()
__call() запускается при вызове недоступных методов в контексте объект.
обязательно два параметра (название метода, значение переменной)

    function __call($method, $args)
    {
        echo "перегрузка магического метода __call. Попытка вызова метода $method";
    }

### __callStatic()
__callStatic() запускается при вызове недоступных методов в статическом контексте.
обязательно два параметра (название статического метода, значение переменной)

    static function __callStatic($method, $args)
    {
        echo "перегрузка магического метода __callStatic. Попытка вызова статического метода $method";
    }

### __get()
Метод __get() будет выполнен при чтении данных из недоступных (защищённых или приватных) или несуществующих свойств.
обязательно один параметр (название переменной)

    function __get($value)
    {
        echo "перегрузка магического метода __get. Попытка получить переменную $value";
    }

### __set()
Метод __set() будет выполнен при записи данных в недоступные (защищённые или приватные) или несуществующие свойства.
обязательно два параметра (название переменной, значение переменной) + использовать функцию isset($class->property)

    function __set($name, $value)
    {
        print "перегрузка магического метода __get. Попытка установить переменной $name значение $value";
    }

### __isset()
Метод __isset() будет выполнен при использовании isset() или empty() на недоступных (защищённых или приватных) или несуществующих свойствах.
обязательно один параметр (название переменной) + использовать функцию isset($class->property)

    function __isset($name)
    {
        print "перегрузка магического метода __isset. Попытка проверить установлена переменная $name или нет";
    }

### __unset()
Метод __unset() будет выполнен при вызове unset() на недоступном (защищённом или приватном) или несуществующем свойстве.
обязательно один параметр (название переменной) + использовать функцию unset($class->property)

    function __unset($name)
    {
        print "перегрузка магического метода __unset. Попытка проверить отсутствует перменная $name или нет";
    }

### __sleep()
Назначение метода __sleep() — зафиксировать отложенные данные или выполнить аналогичные задачи очистки. Метод также будет полезным, когда требуется сохранить только часть объекта.

Методу __sleep() нельзя возвращать названия закрытых свойств родительских классов. Это сгенерирует ошибку уровня E_NOTICE.

Для сериализации закрытых родительских свойств вместо магического метода __sleep вызывают магический метод __serialize().

    public function __sleep()
    {
        return array('dsn', 'username', 'password');
    }
### __wakeup()
Назначение метода __wakeup() — восстановить соединения с базой данных, которые потерялись при сериализации, и выполнить другие задачи повторной инициализации.

    public function __wakeup()
    {
        $this->connect();
    }
### __serialize()
Назначение метода __serialize() заключается в определении удобного для сериализации произвольного представления объекта. Элементам массива разрешается соответствовать свойствам объекта, но это не обязательно.

<?php

class Connection
{
    protected $link;
    private $dsn, $username, $password;

    public function __construct($dsn, $username, $password)
    {
        $this->dsn = $dsn;
        $this->username = $username;
        $this->password = $password;
        $this->connect();
    }

    private function connect()
    {
        $this->link = new PDO($this->dsn, $this->username, $this->password);
    }

    public function __serialize(): array
    {
        return [
          'dsn' => $this->dsn,
          'user' => $this->username,
          'pass' => $this->password,
        ];
    }

    public function __unserialize(array $data): void
    {
        $this->dsn = $data['dsn'];
        $this->username = $data['user'];
        $this->password = $data['pass'];

        $this->connect();
    }
}

?>

Замечание:
    При определении в классе обоих методов — и __serialize(), и __sleep(), PHP вызовет только метод __serialize(). Метод __sleep() проигнорируется. PHP проигнорирует интерфейсный метод serialize(), и вместо него вызовет метод __serialize(), если класс реализует интерфейс Serializable.
### __unserialize()
И наоборот, функция unserialize() проверяет доступность магического метода __unserialize(). PHP передаст методу массив, который восстановил и вернул метод __serialize(), если метод определили в классе. А затем, если потребуется, метод восстановит свойства объекта из этого массива.
<?php

class Connection
{
    protected $link;
    private $dsn, $username, $password;

    public function __construct($dsn, $username, $password)
    {
        $this->dsn = $dsn;
        $this->username = $username;
        $this->password = $password;
        $this->connect();
    }

    private function connect()
    {
        $this->link = new PDO($this->dsn, $this->username, $this->password);
    }

    public function __serialize(): array
    {
        return [
          'dsn' => $this->dsn,
          'user' => $this->username,
          'pass' => $this->password,
        ];
    }

    public function __unserialize(array $data): void
    {
        $this->dsn = $data['dsn'];
        $this->username = $data['user'];
        $this->password = $data['pass'];

        $this->connect();
    }
}

?>

Замечание:
    При определении в классе обоих методов — и __unserialize(), и __wakeup(), PHP вызовет только метод __unserialize(), а метод __wakeup() проигнорируется.

### __toString()
Метод __toString() разрешает классу выбирать, как класс будет реагировать, когда с ним обращаются как со строкой. Например, класс решает, что выведет выражение echo $obj;

    function __toString()
    {
        return "Имя разработчика: ". $this->name;
    }

!!Строгое замечание:
    С PHP 8.0.0 возвращаемое значение соответствует стандартной семантике PHP-типов, поэтому значение приводится к строке (string), если возможно и если отключили строгую типизацию.
### __invoke()
Метод __invoke() вызывается, когда скрипт пытается выполнить объект как функцию.

Пример (1):
    function __invoke(){
        return "вызов метода __invoke (попытка вызова объект класса как функцию)";
    }
    
Пример (2):
    <?php

    class CallableClass
    {
        public function __invoke($x)
        {
            var_dump($x);
        }
    }

    $obj = new CallableClass();

    $obj(5); //int(5)
    var_dump(is_callable($obj)); //bool(true)

    ?>

### __set_state()
Этот статический метод вызывается для тех классов, которые экспортируются функцией var_export().
ДЛЯ СПРАВКИ!
---
(Функция var_export())
var_export — Выводит или возвращает интерпретируемое строковое представление переменной

var_export(mixed $value, bool $return = false): ?string

var_export() возвращает структурированную информацию о данной переменной. Функция аналогична var_dump() за одним исключением: возвращаемое представление является полноценным PHP-кодом.

Список параметров
[value]
Переменная, которую необходимо экспортировать.

[return]
Если передано и значение равно true, var_export() вернёт представление переменной вместо его вывода.
---
Единственный параметр метода — массив, который содержит экспортируемые свойства в виде ['property' => value, ...].

<?php

class A
{
    public $var1;
    public $var2;

    public static function __set_state($an_array)
    {
        $obj = new A;
        $obj->var1 = $an_array['var1'];
        $obj->var2 = $an_array['var2'];
        return $obj;
    }
}

$a = new A();
$a->var1 = 5;
$a->var2 = 'foo';

$b = var_export($a, true);
var_dump($b);
eval('$c = ' . $b . ';');
var_dump($c);

?>

Результат выполнения приведённого примера:

string(60) "A::__set_state(array(
   'var1' => 5,
   'var2' => 'foo',
))"
object(A)#2 (2) {
  ["var1"]=>
  int(5)
  ["var2"]=>
  string(3) "foo"
}

### __clone()
Копия объекта создаётся с использованием ключевого слова clone (который вызывает метод __clone() объекта, если это возможно).

$copy_of_object = clone $object;

После завершения клонирования, если метод __clone() определён, то будет вызван метод __clone() вновь созданного объекта для возможного изменения всех необходимых свойств.

<?php
class SubObject
{
    static $instances = 0;
    public $instance;

    public function __construct() {
        $this->instance = ++self::$instances;
    }

    public function __clone() {
        $this->instance = ++self::$instances;
    }
}

class MyCloneable
{
    public $object1;
    public $object2;

    function __clone()
    {
        // Принудительно клонируем this->object1, иначе
        // он будет указывать на один и тот же объект.
        $this->object1 = clone $this->object1;
    }
}

$obj = new MyCloneable();

$obj->object1 = new SubObject();
$obj->object2 = new SubObject();

$obj2 = clone $obj;


print "Оригинальный объект:\n";
print_r($obj);

print "Клонированный объект:\n";
print_r($obj2);

?>

Результат выполнения приведённого примера(1):

Оригинальный объект:
MyCloneable Object
(
    [object1] => SubObject Object
        (
            [instance] => 1
        )

    [object2] => SubObject Object
        (
            [instance] => 2
        )

)
Клонированный объект:
MyCloneable Object
(
    [object1] => SubObject Object
        (
            [instance] => 3
        )

    [object2] => SubObject Object
        (
            [instance] => 2
        )

)

Возможно обращаться к свойствам/методам только что склонированного объекта:

<?php
$dateTime = new DateTime();
echo (clone $dateTime)->format('Y');
?>

Результат выполнения приведённого примера(2):
2016

### __debugInfo()
Этот метод вызывается функцией var_dump(), когда требуется вывести список свойств объекта. Функция выведет каждое объектное свойство c модификаторами public, protected и private, если метод не определили.

__debugInfo(): array

<?php

class C
{
    private $prop;

    public function __construct($val)
    {
        $this->prop = $val;
    }

    public function __debugInfo()
    {
        return [
            'propSquared' => $this->prop ** 2,
        ];
    }
}

var_dump(new C(42));

?>

Результат выполнения приведённого примера:

object(C)#1 (1) {
  ["propSquared"]=>
  int(1764)
}
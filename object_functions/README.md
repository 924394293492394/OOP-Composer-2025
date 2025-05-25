# 📚 OOP-Composer-2025
Изучение объектно-ориентированного программирования в PHP  
🗓 Старт: 24/05/2025 — Конец: 25/05/2025 12:41PM

---

## 📌 План изучения

### 🔸 `__autoload`
  Пытается загрузить неопределённый класс  
  **Формат:** `__autoload(string $class): void`  
  ⚠️ Устарела с PHP 7.2.0. Удалена в PHP 8.0.0. Использовать не рекомендуется.

---

### 🔸 `class_alias`
  Создаёт псевдоним класса  
  **Формат:** `class_alias(string $class, string $alias, bool $autoload = true): bool`

Метод создаёт псевдоним alias для пользовательского класса class. Класс-псевдоним — тот же исходный класс.

```php
class_alias('Workerr', 'Workff', true);
$worker = new Workff('Boris4', 20, [5, 6, 10]);
```

---

### 🔸 `class_exists`
  Проверяет, объявили ли класс  
  **Формат:** `class_exists(string $class, bool $autoload = true): bool`

Пример использования c параметром autoload:
```php
spl_autoload_register(function ($class_name) {
    include $class_name . '.php';
    if (!class_exists($class_name, false)) {
        throw new LogicException("Unable to load class: $class_name");
    }
});

if (class_exists(MyClass::class)) {
    $myclass = new MyClass();
}
```

---

### 🔸 `enum_exists`
  Проверяет, определили ли перечисление  
  **Формат:** `enum_exists(string $enum, bool $autoload = true): bool`

```php
var_dump(enum_exists('Character', false)); //true (за счет require_once("./Developer.php"); require_once("./Designer.php"); require_once("./Workerr.php");
```

---

### 🔸 `get_called_class`
  Получает имя класса через позднее статическое связывание  
  **Формат:** `get_called_class(): string`

Функция получает имя класса, из которого вызвали статический метод.
---

### 🔸 `get_class`
  Возвращает имя класса, которому принадлежит объект  
  **Формат:** `get_class(object $object = ?): string`

```php
var_dump(get_class($developer)); // string(9) "Developer"
```

---

### 🔸 `get_class_methods`
  Возвращает массив имён методов класса  
  **Формат:** `get_class_methods(object|string $object_or_class): array`

```php
var_dump(get_class_methods('Developer'));
```

Вывод:
array(6) {
  [0]= 
  string(11) "__construct"
  [1]= 
  string(4) "work"
  [2]= 
  string(12) "now_position"
  [3]= 
  string(8) "getHours"
  [4]= 
  string(11) "setPosition"
  [5]= 
  string(11) "getPosition"
}

---

### 🔸 `get_class_vars`
  Получает свойства класса, которые объявлены по умолчанию  
  **Формат:** `get_class_vars(string $class): array`

```php
var_dump(get_class_vars('Developer'));
```

Вывод:
array(4) {
  ["name"]= 
  NULL
  ["age"]= 
  NULL
  ["hours"]= 
  NULL
  ["possibility"]= 
  NULL
}

---

### 🔸 `get_declared_classes`
  Возвращает массив имён всех объявленных классов  
  **Формат:** `get_declared_classes(): array`
(в этот список входят все подключенные файлы внутри классов, перечисления также включаются!)

```php
print_r(get_declared_classes());
```

Вывод приведённого примера будет похож на:
Array
(
    [0] =  stdClass
    [1] =  __PHP_Incomplete_Class
    [2] =  Directory
)

---

### 🔸 `get_declared_interfaces`
  Возвращает массив объявленных интерфейсов  
  **Формат:** `get_declared_interfaces(): array`

```php
print_r(get_declared_interfaces());
```

Вывод приведённого примера будет похож на:
Array
(
    [0] =  Traversable
    [1] =  IteratorAggregate
    [2] =  Iterator
    [3] =  ArrayAccess
    [4] =  reflector
    [5] =  RecursiveIterator
    [6] =  SeekableIterator
)

---

### 🔸 `get_declared_traits`
  Возвращает массив объявленных трейтов  
  **Формат:** `get_declared_traits(): array`

по умолчанию трейтов в самих php файлов нету как например с классами и интерфейса (php автоматические подгружает классы и интерфейсы во все файлы необходимую реализацию:
interfaces [0] =  Traversable
           [1] =  IteratorAggregate
           [2] =  Iterator
           [3] =  Serializable
           [4] =  ArrayAccess
           [5] =  Countable
           [6] =  Stringable)

```php
namespace Example;

trait FooTrait {}
abstract class FooAbstract {}
class Bar extends FooAbstract {
    use FooTrait;
}

$array = get_declared_traits();
var_dump($array);
```

Вывод:
array(1) {
 [0] =  string(23) "Example\FooTrait"
}

---

### 🔸 `get_mangled_object_vars`
  Возвращает массив искажённых свойств объекта  
  **Формат:** `get_mangled_object_vars(object $object): array`

Функция возвращает массив (array), элементы которого — свойства объекта. Ключами массива будут имена переменных-членов, с рядом примечательных исключений: в начало имён закрытых переменных добавляется имя класса; в начало имён защищённых переменных — символ *. Функция также добавит NUL-байты слева и справа от звёздочки и имени класса. Неинициализированные типизированные свойства автоматически отбрасываются.

PUBLIC -  [$var =  $value]
PROTECTED -  [ * $var =  $value]
PRIVATE -  [ClassName $var =  $value]

```php
class A {
    public $public = 1;
    protected $protected = 2;
    private $private = 3;
}
class B extends A {
    private $private = 4;
}

$object = new B;
$object- dynamic = 5;
$object- {'6'} = 6;

var_dump(get_mangled_object_vars($object));
```

Результат выполнения приведённого примера:
array(6) {
  [" B private"]= 
  int(4)
  ["public"]= 
  int(1)
  [" * protected"]= 
  int(2)
  [" A private"]= 
  int(3)
  ["dynamic"]= 
  int(5)
  [6]= 
  int(6)
}
array(2) {
  [" AO private"]= 
  int(1)
  ["dynamic"]= 
  int(2)
}

---

### 🔸 `get_object_vars`
  Возвращает видимые свойства указанного объекта  
  **Формат:** `get_object_vars(object $object): array`

Возвращает видимые нестатические свойства указанного объекта object в соответствии с областью видимости.

---

### 🔸 `get_parent_class`
  Получает имя родительского класса  
  **Формат:** `get_parent_class(object|string $object_or_class = ?): string|false`

```php
class Dad {}
class Child extends Dad {
    function __construct() {
        echo "I'm " . get_parent_class($this) . "'s son
";
    }
}
class Child2 extends Dad {
    function __construct() {
        echo "I'm " . get_parent_class('child2') . "'s son too
";
    }
}
$foo = new Child();
$bar = new Child2();
```

---

### 🔸 `interface_exists`
  Проверяет, определён ли интерфейс  
  **Формат:** `interface_exists(string $interface, bool $autoload = true): bool`

```php
if (interface_exists('MyInterface')) {
    class MyClass implements MyInterface {
        // ... (методы)
    }
}
```

---

### 🔸 `is_a`
  Проверяет, принадлежит ли объект указанному типу или его подтипу  
  **Формат:** `is_a(mixed $object_or_class, string $class, bool $allow_string = false): bool`

Функция определяет, принадлежит ли объект или класс object_or_class типу class, или относится ли тип объекта или класса к подтипу супертипа class.

---

### 🔸 `is_subclass_of`
  Проверяет, является ли класс потомком другого класса или реализует интерфейс  
  **Формат:** `is_subclass_of(mixed $object_or_class, string $class, bool $allow_string = true): bool`

Функция проверяет, принадлежит ли объект или класс object_or_class к потомкам класса class, или реализует ли объект или класс, или родители объекта или класса, интерфейс.

```php
var_dump(is_subclass_of($worker, 'Developer')); // false
var_dump(is_subclass_of($developer, 'Workerr')); // true
```

---

### 🔸 `method_exists`
  Проверяет, определён ли метод в классе  
  **Формат:** `method_exists(object|string $object_or_class, string $method): bool`

```php
var_dump(method_exists($developer, 'work22')); // false
```

---

### 🔸 `property_exists`
  Проверяет, есть ли у объекта или класса свойство  
  **Формат:** `property_exists(object|string $object_or_class, string $property): bool`

```php
$check = property_exists($developer, 'name');
var_dump($check); // true
```

---

### 🔸 `trait_exists`
  Проверяет, существует ли трейт  
  **Формат:** `trait_exists(string $trait, bool $autoload = true): bool`

```php
trait World {
    private static $instance;
    protected $tmp;

    public static function World() {
        self::$instance = new static();
        self::$instance- tmp = get_called_class().' '.__TRAIT__;
        return self::$instance;
    }
}

if (trait_exists('World')) {
    class Hello {
        use World;
        public function text($str) {
            return $this- tmp . $str;
        }
    }
}

echo Hello::World()- text('!!!'); // Hello World!!!
```
# 📚 Встроенные функции PHP
Разбор интересных встроенных функций в PHP  
🗓 Старт: 27/05/2025 — Конец: 28/05/2025 4:47PM

---

## 📌 План изучения

### 🔸 `произвольное кол-во параметров`
    позволяет определять функции с необязательными параметрами. Однако существует способ, разрешающий совершенно произвольное количество параметров у функции.
  **Формат:** `func_get_args() и func_get_arg($id)`


```php
//произвольное кол-во параметров
function foo($arg1 = '', $arg2 = '') {

	echo "arg1: $arg1\n";
	echo "arg2: $arg2\n";

}

foo('hello','world');
foo();

//безлимитное кол-во параметров 
function foo2(){
    $args = func_get_args();
    print_r($args);
    //можно перебрать через foreach
}

foo2('hello', 'world', 'again');
```

### 🔸 `изпользование glob() для поиска файлов в каталоге`
    можно задавать несколько видов файлов и получать массив со значениями в виде пути файла в проекте.
  **Формат:** `glob(string $pattern, int $flags = 0): array|false`

```php
//вывод списка всех файлов данного типа
foreach (glob("./graph_traversal/*.{js,php}", \GLOB_BRACE) as $filename){
    echo "Размер файла $filename в байтах — " . filesize($filename) . "\n";
}
```
Функция неприменима для работы с удалёнными файлами, поскольку файл должен быть доступен через файловую систему сервера.

### 🔸 `Сведения об использовании памяти memory_get_usage()`
Возвращает количество памяти в байтах, которую потребляет PHP-скрипт или которую система выделила PHP-процессу. Второй параметр при [true] отвечает за вывод общего объема потребляемой памяти для всех процессов. При [false] функция выдает информацию только по текущему процессу.
  **Формат:** `memory_get_usage(bool $real_usage = false): int`

### 🔸 `memory_get_peak_usage() `
Возвращает пиковое значение памяти, которую потребил PHP-скрипт или которую система выделила PHP-процессу
  **Формат:** ``

```php
echo "\nInitial: ".memory_get_usage()." bytes";
//Initial: 405856 bytes

for ($i = 0; $i < 100000; $i++) {
	$array []= md5($i);
}

for ($i = 0; $i < 100000; $i++) {
	unset($array[$i]);
}

echo "Final: ".memory_get_usage()." bytes \n";
//Final: 4600240 bytes
echo "Peak: ".memory_get_peak_usage()." bytes \n";
//Peak: 11000272 bytes
```

### 🔸 `memory_limit()`
Позволяет задавать максимальный объем памяти в байтах, который разрешается использовать скрипту. Это помогает предотвратить ситуацию, при которой плохо написанный скрипт съедает всю доступную память сервера. Чтобы убрать ограничения, установите для директивы значение -1.
  **Формат:** `memory_limit(int $value)`

```php
echo "\nInitial: ".memory_get_usage()." bytes";
//Initial: 405856 bytes

for ($i = 0; $i < 100000; $i++) {
	$array []= md5($i);
}

for ($i = 0; $i < 100000; $i++) {
	unset($array[$i]);
}

echo "Final: ".memory_get_usage()." bytes \n";
//Final: 4600240 bytes
echo "Peak: ".memory_get_peak_usage()." bytes \n";
//Peak: 11000272 bytes
```

### 🔸 `md5()`
Возвращает MD5-хеш строки    
  **Формат:** `md5(string $string, bool $binary = false): string`

```php
for ($i = 0; $i < 100000; $i++) {
	$array []= md5($i);
}
print_r($array);
```
Вывод:
[...
    [99833] => d2abdf99c511d85536f600fc06228105
    [99834] => bc1dc12a2240cdacd2ed3ee02898a8f8
    [99835] => a774bcd73f9823c8c1520e7039bd30c8
    [99836] => 711129bd67846cec1e7f26adf3b273bf
    [99837] => 6411b40320f35aac71f2a11308686aec
    [99838] => cf5536b78bfeefa9be669cdb50e32606
    [99839] => 204d973b8e717ed5bc2e30f726a5ecff
    [99840] => c06685da3174c8e5562202dea93d48ee
...]

Вычисляет MD5-хеш строки string, используя » алгоритм MD5 RSA Data Security, Inc. и возвращает этот хеш.

### 🔸 `сведения об использовании CPU getusage()`
Получает информацию об использовании текущего ресурса
  **Формат:** `getrusage(int $mode = 0): array|false`

```php
$dat = getrusage();
print_r($dat);
echo $dat["ru_utime.tv_usec"]. "\n"; // время на задачи пользователя (user time) (микросекунды)
echo $dat["ru_utime.tv_sec"]. "\n";  // время на задачи пользователя (user time) (секунды)
echo $dat["ru_stime.tv_usec"]. "\n"; // время на системные задачи (system time) (микросекунды)
echo $dat["ru_stime.tv_sec"];  // время на системные задачи (system time) (секунды)
```

Возвращает ассоциативный массив, содержащий данные возвращённые из системного вызова. Имена элементов соответствуют документированным именам полей. Возвращает false в случае возникновения ошибки.

### 🔸 `Магические константы`
PHP включает ряд магических констант, значение которых изменяется в зависимости от контекста. Значение константы __LINE__, например, зависит от строки скрипта, на которой указали константу. PHP разрешает «магические» константы во время компиляции, в отличие от стандартных констант, которые PHP разрешает во время выполнения. Специальные константы нечувствительны к регистру, а список таких констант приводит следующий параграф: __LINE__, __FILE__, __DIR__,
__FUNCTION__, __CLASS__, __TRAIT__, __METHOD__, __PROPERTY__, __METHOD__, __PROPERTY__, __NAMESPACE__;
   
### 🔸 `Генерация рандомного значения`
1. srand()
Задаёт начальное число генератора псевдослучайных чисел
  **Формат:** `srand(?int $seed = null, int $mode = MT_RAND_MT19937): void`
Устанавливает начальное число генератора случайных чисел равным seed или случайному числу, если значение параметра seed равно 0.
---
2. getrandmax()  
Возвращает максимальное значение, которое может быть получено функцией rand().   
  **Формат:** `getrandmax(): int`
---
3. mt_rand()
Генерирует случайное значение через генератор случайных чисел на базе Вихря Мерсенна      
  **Формат:** `mt_rand(int $min, int $max): int   ИЛИ   mt_rand(): int`
на основе Вихря Мерсенна и генерирует случайные числа в среднем в четыре раза быстрее, чем функция rand() 
---
4. random_int()
Получает криптографически безопасное равномерно выбранное целое число. Функция создаёт равномерно выбранное целое число между заданными минимумом и максимумом.     
  **Формат:** `random_int(int $min, int $max): int`
---
5. random_bytes()
Получает криптографически безопасные случайные байты. Функция создаёт строку, которая содержит равномерно выбранные случайные байты с запрошенной длиной length.      
  **Формат:** `random_bytes(int $length): string`

### 🔸 `Сжатие строк gzcompress() или gzencode()`
Сжимает в строки любой длины без впутывания любых архивных файлов.
  **Формат:** `gzcompress(string $data, int $level = -1, int $encoding = ZLIB_ENCODING_DEFLATE): string|false`

```php
$string =
"Lorem ipsum dolor sit amet, consectetur
adipiscing elit. Nunc ut elit id mi ultricies
adipiscing. Nulla facilisi. Praesent pulvinar,
sapien vel feugiat vestibulum, nulla dui pretium orci,
non ultricies elit lacus quis ante. Lorem ipsum dolor
sit amet, consectetur adipiscing elit. Aliquam
pretium ullamcorper urna quis iaculis. Etiam ac massa
sed turpis tempor luctus. Curabitur sed nibh eu elit
mollis congue. Praesent ipsum diam, consectetur vitae
ornare a, aliquam a nunc. In id magna pellentesque
tellus posuere adipiscing. Sed non mi metus, at lacinia
augue. Sed magna nisi, ornare in mollis in, mollis
sed nunc. Etiam at justo in leo congue mollis.
Nullam in neque eget metus hendrerit scelerisque
eu non enim. Ut malesuada lacus eu nulla bibendum
id euismod urna sodales. ";
 
$compressed = gzcompress($string);
 
echo "Original size: ". strlen($string)."\n";
/* prints
Original size:794
*/
 
echo "Compressed size: ". strlen($compressed)."\n";
/* prints
Compressed size: 415
*/
 
// getting it back
$original = gzuncompress($compressed);
```
Возможно достичь уменьшения размера почти на 50%. Функции gzencode() и gzdecode() выдают схожие результаты, используя другим алгоритмом сжатия. 
### 🔸 `Функция Register Shutdown register_shutdown_function()`
Позволяет выполнить какой-нибудь код прямо перед окончанием работы скрипта. Функция регистрирует callback-функцию, которая выполнится после завершения работы скрипта или при вызове функции exit().  
  **Формат:** ``
```php
function finishWork($message = ''){
    echo "Finish processing... ". time() . "$message";
}
register_shutdown_function('finishwork', ' GoodBye! ;)');
// Finish processing... 1748439892 GoodBye! ;)
```
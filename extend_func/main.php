<?php
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


//вывод списка всех файлов данного типа
foreach (glob("./graph_traversal/*.{js,php}", \GLOB_BRACE) as $filename){
    echo "Размер файла $filename в байтах — " . filesize($filename) . "\n";
}

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

$dat = getrusage();
print_r($dat);
echo $dat["ru_utime.tv_usec"]. "\n"; // время на задачи пользователя (user time) (микросекунды)
echo $dat["ru_utime.tv_sec"]. "\n";  // время на задачи пользователя (user time) (секунды)
echo $dat["ru_stime.tv_usec"]. "\n"; // время на системные задачи (system time) (микросекунды)
echo $dat["ru_stime.tv_sec"];  // время на системные задачи (system time) (секунды)

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

function finishWork($message = ''){
    echo "Finish processing... ". time() . "$message";
}
register_shutdown_function('finishwork', ' GoodBye! ;)');

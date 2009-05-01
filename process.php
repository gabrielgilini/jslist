<?php
    if(!empty($_FILES['scriptFile'])){
        $statements = array(
            'create' => 'createList',
            'add' => 'insertVal',
            'del' => 'remVal'
        );
        $processed = array();
        $commands = explode(';', file_get_contents($_FILES['scriptFile']['tmp_name']));
        $test = array();
        //preg_match('%(?P<string_value>(?<=\'|")[\w\d\s]+(?=\'|"))%', '\'sadsd\'', $test);
        /*preg_match($regex = '%\s*(?P<sstring_value>(?<=\'|")[\w\d\s]+(?=\'|"))\s*%im',
            '"sou"', $test);*/
        preg_match('%\w+\s*(?<=(?P<d>[\'"]))[\w\s]+(?=(?P=d))%m', 'add "sou uma string com espacos"', $test);
        var_dump('test:', $test);
        $regex = '%(?P<statement>create|add|del)\s+((?P<int_value>[\d]+)|(?P<string_value>(?<![\'"])[\w]+)|(?P<sstring_value>(?<=(?P<d>[\'"]))[\w\d\s]+(?=(?P=d))))(\s+after\s+(?P<add_after>[\d\w]+|([\'"][^\'"][\'"])))?%im';
        var_dump($regex);
        foreach($commands as $command){
            preg_match($regex, $command, $match);
            var_dump($command, $match);
        }
    }
?>
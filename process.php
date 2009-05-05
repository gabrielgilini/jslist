<?php
    if(!empty($_FILES['scriptFile'])){
        $statements = array(
            'create' => 'createList',
            'destroy' => 'delList',
            'add' => 'insertVal',
            'after' => 'insertValAfter',
            'del' => 'remVal'
        );
        $processed = array();
        $commands = explode(';', file_get_contents($_FILES['scriptFile']['tmp_name']));

        $regex = '%(?P<statement>add|del)\s+[\'"]?(?P<value>(?P<int_value>[\d]+)|(?P<string_value>(?<![\'"])[\w]+)|(?P<qstring_value>(?<=(?P<quotes>[\'"]))[\w\d\s]+(?=(?P=quotes))))(\s+after\s+(?P<add_after>([\d]+)|((?<![\'"])[\w]+)|((?<=(?P<aquotes>[\'"]))[\w\d\s]+(?=(?P=aquotes)))))?%im';
        foreach($commands as $command){
            if(strpos($command, 'create') !== false){
                $processed[] = array($statements['create']);
            }
            elseif(strpos($command, 'destroy') !== false){
                $processed[] = array($statements['destroy']);
            }
            else{
                preg_match($regex, $command, $match);
                $statement = $match['statement'];
                $value = $match['value'];
                $addAfter = $match['add_after'];
                if(!empty($statement) && !empty($value)){
                    $vals = array($value);
                    if(!empty($addAfter)){
                        $vals[] = $addAfter;
                    }
                    $processed[] = array($statements[$statement], $vals);
                }
            }
        }
        echo json_encode($processed);
    }
?>
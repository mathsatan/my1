<?php

class Route
{
    public static function start()
    {
            // контроллер и действие по умолчанию
        $controllerClassName = 'main';
        $action = 'index';

        $request = substr($_SERVER['REQUEST_URI'], 1);
        $routes = preg_split('/\//', $request, -1, PREG_SPLIT_NO_EMPTY);
        unset($request);

        if (!empty($routes[0]))   // получаем имя контроллера
        {
            $controllerClassName = $routes[0];
        }
        if (!empty($routes[1]) )   // получаем имя действия
        {
            $action = $routes[1];
        }

            // добавляем префиксы
        $modelClassName = 'Model'.ucfirst($controllerClassName);
        $controllerClassName = 'Controller'.ucfirst($controllerClassName);
        $action = 'action_'.$action;

        // подцепляем файл с классом модели (файла модели может и не быть)
        $model_path = "app/models/".strtolower($modelClassName).'.php';

        if(file_exists($model_path))
        {
            include $model_path;
        }

            // подцепляем файл с классом контроллера
        $controller_path = "app/controllers/".strtolower($controllerClassName).'.php';
        if(file_exists($controller_path))
        {
            include $controller_path;
        }
        else
        {
            throw new MVCException(E_CONTROLLER_FILE_DOESNT_EXIST.': '.$controller_path);
        }

        try {   // создаем контроллер
            $controller = new $controllerClassName;
            $p = null;
            $p = self::getParams($routes);
        }catch (MVCException $e){
            throw $e;
        }

        if ($p !== false)
            $controller->addParams($p);

        if(method_exists($controller, $action))
        {   // вызываем действие контроллера
            try{
                $controller->$action();
            }catch (PDOException $e1) {
                throw $e1;
            }catch (MVCException $e2) {
                throw $e2;
            }catch (TemplateException $e3) {
                throw $e3;
            }
        }
        else {
            throw new MVCException(E_INCORRECT_ACTION);
        }
    }

    private static function getParams($line)
    {
        if(!empty($line[2]) )  // считываем параметры если есть
        {
            if (count($line) % 2 != 0)
            {
                throw new MVCException(E_INCORRECT_PARAMS);
            }
            $keys = $values = array();
            for($i = 2, $cnt = count($line); $i < $cnt; $i++)
            {
                if($i % 2 == 0){
                    $keys[] = $line[$i];
                }else{
                    $values[] = $line[$i];
                }
            }
            return array_combine($keys, $values);
        }
       return false;
    }

    public static function ErrorPage($errorMSG)
    {
        require_once 'app/controllers/controllererror.php';
        $controllerErr = new ControllerError($errorMSG);
        $controllerErr->action_index();
    }
} 
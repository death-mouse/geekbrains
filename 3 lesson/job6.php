<?php

$menu_arr = [
    [
        'title' => 'Главная',
        'link' => '/'
    ],
    [
        'title' => 'Контакты',
        'link' => '/contancts'
    ],
    [
        'title' => 'Статьи',
        'link' => '/articles',
        'children' => [
            [
                'title' => 'Котики',
                'link' => '/articles/cats'
            ],
            [
                'title' => 'Собачки',
                'link' => '/articles/dogs',
                'children' => [
                    [
                        'title' => 'Доберманы',
                        'link' => '/articles/dogs/dobermani'
                    ],
                    [
                        'title' => 'Корги',
                        'link' => '/articles/dogs/corgi',
                        'children' => [
                            [ 
                                'title' => 'Про Корги',
                                'link' => '/articles/dogs/corgi/about',
                            ],
                            [ 
                                'title' => 'Купить Корги',
                                'link' => '/articles/dogs/corgi/buy',
                                'children' => [
                                                [ 
                                                    'title' => 'В Москве',
                                                    'link' => '/articles/dogs/corgi/buy/moscow',
                                                ],
                                                [ 
                                                    'title' => 'Санкт-Петербург',
                                                    'link' => '/articles/dogs/corgi/buy/spb',
                                                ]
                                            ]
                            ]
                        ]
                    ]
                ]
            ]
        ]
    ]
];

function printMenu($arrayMenu)
{
    foreach($arrayMenu as $value) {
        
        if(array_key_exists("children", $value) ){

            echo "<li><a href=\"".$value["link"]."\">".$value["title"]."</a><ul>";
            
            printMenu($value["children"]);

            echo "</ul></li>";
        }
        else{
            echo "<li><a href=\"".$value["link"]."\">".$value["title"]."</li></a>";
        }
        
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Заголовок</title>
</head>
<body>
   <div class="menu">
        <?php printMenu($menu_arr)?>
    </div> 
</body>
</html>
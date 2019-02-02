<?php
$menu = [
    'home' => [
        0 => [
            'name' => '商品',
            'icon' => 'icon-desktop',
            'list' => [
                0 => [
                    'name' => '商品列表',
                    'link' => '/good/index'
                ],
                1 => [
                    'name' => '新增商品',
                    'link' => '/good/add'
                ]
            ]
        ],
        1 => [
            'name' => '分类',
            'icon' => 'icon-desktop',
            'list' => [
                0 => [
                    'name' => '分类列表',
                    'link' => '/good/index'
                ],
                1 => [
                    'name' => '新增商品',
                    'link' => '/good/add'
                ]
            ]
        ],
        2 => [
            'name' => '品牌',
            'icon' => 'icon-desktop',
            'list' => [
                0 => [
                    'name' => '分类列表',
                    'link' => '/good/index'
                ],
                1 => [
                    'name' => '新增商品',
                    'link' => '/good/add'
                ]
            ]
        ],
        3 => [
            'name' => '评论',
            'icon' => 'icon-desktop',
            'list' => [
                0 => [
                    'name' => '分类列表',
                    'link' => '/good/index'
                ],
                1 => [
                    'name' => '新增商品',
                    'link' => '/good/add'
                ]
            ]
        ],
        4 => [
            'name' => '库存',
            'icon' => 'icon-desktop',
            'list' => [
                0 => [
                    'name' => '分类列表',
                    'link' => '/good/index'
                ],
                1 => [
                    'name' => '新增商品',
                    'link' => '/good/add'
                ]
            ]
        ],
    ],
    'home1' => [
        0 => [
            'name' => '活动',
            'icon' => 'icon-desktop',
            'list' => [
                0 => [
                    'name' => '商品列表',
                    'link' => '/good/index'
                ],
                1 => [
                    'name' => '新增商品',
                    'link' => '/good/add'
                ]
            ]
        ],
        1 => [
            'name' => '广告',
            'icon' => 'icon-desktop',
            'list' => [
                0 => [
                    'name' => '分类列表',
                    'link' => '/good/index'
                ],
                1 => [
                    'name' => '新增商品',
                    'link' => '/good/add'
                ]
            ]
        ],
        2 => [
            'name' => '优惠券',
            'icon' => 'icon-desktop',
            'list' => [
                0 => [
                    'name' => '分类列表',
                    'link' => '/good/index'
                ],
                1 => [
                    'name' => '新增商品',
                    'link' => '/good/add'
                ]
            ]
        ],
        3 => [
            'name' => '推送',
            'icon' => 'icon-desktop',
            'list' => [
                0 => [
                    'name' => '分类列表',
                    'link' => '/good/index'
                ],
                1 => [
                    'name' => '新增商品',
                    'link' => '/good/add'
                ]
            ]
        ],
    ],
    'home2' => [
        0 => [
            'name' => '商品订单',
            'icon' => 'icon-desktop',
            'list' => [
                0 => [
                    'name' => '商品列表',
                    'link' => '/good/index'
                ],
                1 => [
                    'name' => '新增商品',
                    'link' => '/good/add'
                ]
            ]
        ],
        1 => [
            'name' => '充值订单',
            'icon' => 'icon-desktop',
            'list' => [
                0 => [
                    'name' => '分类列表',
                    'link' => '/good/index'
                ],
                1 => [
                    'name' => '新增商品',
                    'link' => '/good/add'
                ]
            ]
        ],
        2 => [
            'name' => '对账',
            'icon' => 'icon-desktop',
            'list' => [
                0 => [
                    'name' => '分类列表',
                    'link' => '/good/index'
                ],
                1 => [
                    'name' => '新增商品',
                    'link' => '/good/add'
                ]
            ]
        ],
    ],
    'home3' => [
        0 => [
            'name' => '商品',
            'icon' => 'icon-desktop',
            'list' => [
                0 => [
                    'name' => '商品列表',
                    'link' => '/good/index'
                ],
                1 => [
                    'name' => '新增商品',
                    'link' => '/good/add'
                ]
            ]
        ],
        1 => [
            'name' => '用户',
            'icon' => 'icon-desktop',
            'list' => [
                0 => [
                    'name' => '分类列表',
                    'link' => '/good/index'
                ],
                1 => [
                    'name' => '新增商品',
                    'link' => '/good/add'
                ]
            ]
        ],
        2 => [
            'name' => '资讯',
            'icon' => 'icon-desktop',
            'list' => [
                0 => [
                    'name' => '分类列表',
                    'link' => '/good/index'
                ],
                1 => [
                    'name' => '新增商品',
                    'link' => '/good/add'
                ]
            ]
        ],
    ],
    'home4' => [
        0 => [
            'name' => '短信',
            'icon' => 'icon-desktop',
            'list' => [
                0 => [
                    'name' => '商品列表',
                    'link' => '/good/index'
                ],
                1 => [
                    'name' => '新增商品',
                    'link' => '/good/add'
                ]
            ]
        ],
        1 => [
            'name' => '管理员',
            'icon' => 'icon-desktop',
            'list' => [
                0 => [
                    'name' => '管理员列表',
                    'link' => '/admin/index'
                ],
                1 => [
                    'name' => '新增商品',
                    'link' => '/good/add'
                ]
            ]
        ],
        2 => [
            'name' => '用户',
            'icon' => 'icon-desktop',
            'list' => [
                0 => [
                    'name' => '分类列表',
                    'link' => '/good/index'
                ],
                1 => [
                    'name' => '新增商品',
                    'link' => '/good/add'
                ]
            ]
        ],
    ]
];

function createSidebar($menu) {
    $html = '';
    if(!empty($menu)){
        $n = 0;
        foreach ($menu as $k=>$v) {
            $html .= '<div class="tab-pane fade in '.($n==0?'active':'').'" id="'.$k.'">';
            $html .= '<ul>';
            if (!empty($v)) {
                foreach ($v as $val) {
                    $html .= '<li>';
                    if (isset($val['link'])) {
                        $html .= '<a href="'.$val['link'].'">';
                    }else{
                        $html .= '<a class="'.((isset($val['list']) && !empty($val['list'])) ? 'dropdown-toggle':'').'">';
                    }
                    $html .= isset($val['icon']) ? '<i class="'.$val['icon'].'"></i>':'';
                    $html .= '<span class="menu-text">'.$val['name'].'</span>';
                    $html .= '</a>';
                    if (isset($val['list']) && !empty($val['list'])) {
                        $html .= '<ul class="submenu">';
                        foreach ($val['list'] as $value) {
                            $html .= '<li>';
                            $html .= '<a href="'.$value['link'].'">';
                            $html .= '<span class="menu-text">'.$value['name'].'</span>';
                            $html .= '</a>';
                            $html .= '</li>';
                        }
                        $html .= '</ul>';
                    }
                    $html .= '</li>';
                }
            }
            $html .= '</ul>';
            $html .= '</div>';
            $n ++;
        }
    }
    return $html;
}
$menuHtml = createSidebar($menu);
?>
<div class="sidebar tab-content">
    <?= $menuHtml?>
</div>

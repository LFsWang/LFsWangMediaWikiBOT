<?php
$post['login']['action'] ='login';
$post['login']['format'] ='json';
$post['login']['lgname'] =$settings['user'];
$post['login']['lgpassword'] =$settings['pass'];

$post['logout']['action'] ='logout';
$post['logout']['format']	='json';

$post['allpage']['action']	='query';
$post['allpage']['format']	='json';
$post['allpage']['list'  ]	='allpages';
$post['allpage']['aplimit']	= 100;

$post['edittoken']['action'] ='tokens';
$post['edittoken']['format'] ='json';
$post['edittoken']['type'  ] ='edit';

$post['getpage']['action'] ='query';
$post['getpage']['format'] ='json';
$post['getpage']['prop'  ] ='revisions';
$post['getpage']['rvprop'] ='content';
$post['getpage']['titles'] ='';

$post['edit_example']['token' ] ='';
$post['edit_example']['action'] ='edit';
$post['edit_example']['format'] ='json';
$post['edit_example']['bot'   ] ='';
?>
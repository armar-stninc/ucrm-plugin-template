<?php
$navigationMenu = array();
$tableHeader = array();
$tableContent = array();
$headerButton = "Template";
$navigationMenu = ['Menu Item 1' => 'selected', 'Menu Item 2' => '', 'Menu Item 3' => ''];
$tableHeader = ['Heading 1', 'Heading 2', 'Heading 3', 'Heading 4', 'Heading 5', ''];
$submitButton = '<a href="public.php?ucrm_action=edit&found=this&that=is" class="button button--success-o"><span>Edit</span></a>';
array_push($tableContent, ['Cell Content 1', 'Cell Content 2', 'Cell Content 3', 'Cell Content 4', 'Cell Content 5', $submitButton]);
array_push($tableContent, ['Cell Content 1', 'Cell Content 2', 'Cell Content 3', 'Cell Content 4', 'Cell Content 5', $submitButton]);
array_push($tableContent, ['Cell Content 1', 'Cell Content 2', 'Cell Content 3', 'Cell Content 4', 'Cell Content 5', $submitButton]);
echo $twig->render('index.html.twig',
    [
        'navigation_menu' => $navigationMenu,
        'header_button' => $headerButton,
        'table_header' => $tableHeader,
        'table_content' => $tableContent,
    ]);

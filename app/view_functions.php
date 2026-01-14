<?php

function alertfy($args){
	$msg = $args[0] ?? false;
	if (!$msg) {
		return '';
	}
	$color 		= $args[1] ?? 'secondary';
	$disappear  = $args[2] ?? false;
	$disappear = $disappear ? ' disappear' : '';
	return '
        <div class="alert alert-' . $color . $disappear . '" role="alert">
            ' . $msg . '
        </div>';
}

function linkfy($args){
        [$request,$color,$msg] = $args;
        return '
        <div class="card mb-2">
            <a href="./' . $request . '" class="btn btn-' . $color . '">
                ' . $msg . '
            </a>
        </div>';
}

function spanfy($args){
    [$color,$url,$icon] = $args;
    return '
            <a class="btn btn-' . $color . ' btn-sm text-white" href="' . $url . '">
                <span class="material-icons-outlined md-12 align-text-top">' . $icon . '</span>
            </a>';
}

function buttonfy($args){
        [$color,$msg,$disappear] = $args;
        $disappear = $disappear ? ' disappear' : '';
        return '
        <div class="alert alert-' . $color . $disappear . '" role="alert">
            ' . $msg . '
        </div>';
}

function modal($modal,$title,$msg,$label){
	include 'toChange/' . 'modal.php';
}

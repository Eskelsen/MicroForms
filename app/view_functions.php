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

function modal($modal_id,$title,$msg){
    return '<div class="modal fade" id="' . $modal_id . '" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

        <div class="modal-header">
            <h5 class="modal-title">' . $title . '</h5>
            <button class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body" id="microformsConfirmMessage">
            ' . $msg . '
        </div>

        <div class="modal-footer">
            <button class="btn btn-secondary" data-bs-dismiss="modal" id="microformsConfirmCancel">
            Cancelar
            </button>
            <button class="btn btn-danger" id="microformsConfirmOk">
            Confirmar
            </button>
        </div>

        </div>
    </div>
    </div>';
}

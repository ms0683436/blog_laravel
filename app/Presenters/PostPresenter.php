<?php
namespace App\Presenters;

use Illuminate\Support\Facades\Auth;

class PostPresenter
{
    public function getLikeButton($post_id, $isActive)
    {
        $onclick = "";
        $title = "";
        if (!Auth::check()) {
            $class = "btn btn-outline-success disabled";
            $ariaPressed = "false";
            $title = "you have to login!";
        }
        else if ($isActive) {
            $class = "btn btn-outline-success active";
            $ariaPressed = "true";
            $onclick = "likeFunction($post_id, 1)";
        }
        else {
            $class = "btn btn-outline-success";
            $ariaPressed = "false";
            $onclick = "likeFunction($post_id, 1)";
        }

        $button = "<button type='button' data-toggle='button' id='like$post_id' onclick='$onclick' title='$title' class='$class' aria-pressed='$ariaPressed'>";
        return $button;
    }
}

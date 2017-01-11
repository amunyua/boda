/**
 * Created by joel on 12/7/16.
 */

$('.delete_user').on('click', function(){
    if(confirm('Are you sure you want to DELETE the selected User?')){
        return true;
    }else{
        return false;
    }
});

$('.block-btn').on('click', function(){
    if(confirm('Are you sure you want to BLOCK the selected User?')){
        return true;
    }else{
        return false;
    }
});

$('.unblock-btn').on('click', function(){
    if(confirm('Are you sure you want to UNBLOCK the selected User?')){
        return true;
    }else{
        return false;
    }
});
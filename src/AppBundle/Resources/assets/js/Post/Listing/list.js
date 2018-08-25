jQuery(function ($) {
    var likePostButton = $('.like-post-ajax-vote');
    var favoritePostButton = $('.favorite-post-ajax-vote');

    likePostButton.click(function(){
        $(this).unbind('click');
        var icon = $('#icon-like-post-vote-number-' + $(this).attr('post-id'));
        icon.removeClass('far');
        icon.addClass('fas');
        ajaxCallOnRoute(
            Routing.generate('app_post_voting_vote_like_post', {id: $(this).attr('post-id')}),
            function(data){
                $('#like-post-vote-number-' + $(this).attr('post-id')).html(data['votes']);
            }.bind(this));
    });

    favoritePostButton.click(function(){
        $(this).unbind('click');
        var icon = $('#icon-favorite-post-vote-number-' + $(this).attr('post-id'));
            icon.removeClass('far');
            icon.addClass('fas');
        ajaxCallOnRoute(
            Routing.generate('app_post_voting_vote_favorite_post', {id: $(this).attr('post-id')}),
            function(data){
                console.log("Salut");
                console.log(data);
                $('#favorite-post-vote-number-' + $(this).attr('post-id')).html(data['votes']);
            }.bind(this));
    });

    var ajaxCallOnRoute = function(route, successCallback, errorCallback){
        $.ajax({
            url: route,
            type: 'GET',
            success: function(data){
                successCallback(data);
            },
            error: errorCallback,
        })

    }
});
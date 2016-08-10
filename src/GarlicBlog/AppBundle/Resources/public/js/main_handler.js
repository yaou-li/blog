$(document).ready(function(){
    
    //click add a new article will redirect to new article page
    $("#add_new_article").click(function(){
        window.location.href = '/newArticle';
    });
    
    //click article title will redirect to single article page
    $(".title_article").click(function(){
        var articleId = $(this).closest('li.list_article').data("article-id");
        window.location.href = '/articles/' + articleId;
    });
    
    //click author name should filter the article by author name
    $(".author_article").click(function(){
        var authorid = $(this).closest('li.list_article').data("author-id");
    });
    
    //click the favorite icon will add the article to favorite.
    $(".icon_favorite").click(function(){
        var self = $(this);
        var articleEm = self.closest('li.list_article')
        var articleId = articleEm.data('article-id');
        var userId = articleEm.data("user-id");
        
        if (self.hasClass('glyphicon-star-empty')) {
            var afterSuccess = function (data) {
                //update the current icon and remove the class
                self.removeClass('glyphicon-star-empty').addClass('glyphicon-star');
            }
            var action = 'add';
        }
        
        else if (self.hasClass('glyphicon-star')) {
            var afterSuccess = function (data) {
                //update the current icon and remove the class
                self.removeClass('glyphicon-star').addClass('glyphicon-star-empty');
            }
            var action = 'remove';
        }
        
        editFavorite(articleId,userId,action,afterSuccess);
    });
    
});
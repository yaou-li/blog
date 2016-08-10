/*
 * edite a article to user's favorite.
 * @param {int} articleId
 * @param {int} userId
 * @param {string} action - either "remove" or "add"
 * @param {function} successCallBack
 * @param {function} failCallBack
 */
var editFavorite = function (articleId,userId,action,successCallBack,failCallBack) {
    // If no article or no user id, do nothing
    if (articleId == null || userId == null || action == null) return false;
    var params = { articleId : articleId, userId : userId, action : action};
    $.ajax({
        url: "/editFavorite",
        method: "POST",
        data : params,
        dataType : "text"
    }).done(function(data){
        if (successCallBack != null) {
            successCallBack(data);
        }
    }).fail(function(data){
        console.error(data);
    }); 
}

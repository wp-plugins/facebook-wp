var addComment =  function() {
	top.location = 'http://mail.ru';
}
FB.Event.subscribe('comment.create', addComment);
var removeComment = function() {
	alert('Comment removed!');
}

FB.Event.subscribe('comments.remove', function(a,b,c) {
	alert(a);
});

// 定义最后光标对象
var lastEditRange;

// 编辑框点击事件
function comments_edit_mouseup(){
	try{
		lastEditRange = getSelection().getRangeAt(0);
	}catch(e){}
}

// 编辑框按键弹起事件
function comments_edit_keyup(){
	try{
		lastEditRange = getSelection().getRangeAt(0);
	}catch(e){}
}

// 表情点击事件
function meme_click(obj){
	var url = $(obj).find('img').attr('src');
	var html = '<img class="smilies" src="' + url +'">';
	
	comments_edit_insert(html);
	
	$(obj).parent().parent().parent().toggleClass('meme_popup');
}

function comments_edit_insert(html){
	var edit = document.getElementById('comments_edit');
	edit.focus();
	
	var el = document.createElement('div');
	el.innerHTML = html;
	
	var selection = getSelection();
	
	if (lastEditRange) {
		selection.removeAllRanges();
		selection.addRange(lastEditRange);
	}

	var range = selection.getRangeAt(0);
	range.deleteContents();
	
	
	var frag = document.createDocumentFragment(), node, lastNode;
	while ( (node = el.firstChild) ) {
		lastNode = frag.appendChild(node);
	}
	
	range.insertNode(frag);
	if (lastNode) {
		range = range.cloneRange();
		range.setStartAfter(lastNode);
		range.collapse(true);
		selection.removeAllRanges();
		selection.addRange(range);
	}
		
	lastEditRange = selection.getRangeAt(0);
}

function meme_btn_click(obj){
	var meme = $(obj).parent();
	$('.meme').not(meme).removeClass('meme_popup');
	meme.toggleClass('meme_popup');
	$('.comments_control_popup').removeClass('comments_control_popup');
}

function comments_edit_mouseout(){
	if (lastEditRange && getSelection().getRangeAt(0).commonAncestorContainer == $('#comments_edit')[0]) {
		lastEditRange = getSelection().getRangeAt(0);
	}
}

//评论控制
function comments_control(obj){
	var
		li = $(obj).parent(),
		div = li.find('div');
	
	if(div.css('display') == 'none'){
		$('.meme_popup').removeClass('meme_popup');
		$('.comments_control_popup').removeClass('comments_control_popup');
		li.addClass('comments_control_popup');
	}else{
		$('.comments_control_popup').removeClass('comments_control_popup');
	}
}
$.fn.serializeObject = function(){
	var a = $('[name]',this);
	var obj = new Object();
	
	for(i=0;i<a.length;i++){
		var b = $(a[i]);
		obj[b.attr('name')] = b.val();
	}
	return obj;
}
function comments_submit(){
  	$('.comment-respond input[name="comment"]').val($('#comments_edit').html());
 	$('#commentform').submit();
}
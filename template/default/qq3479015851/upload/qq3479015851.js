// 图片上传demo
jQuery(function(){
    var $ = jQuery,
        $list = $('#fileList'),
        // 优化retina, 在retina下这个值是2
        ratio = window.devicePixelRatio || 1,

        // 缩略图大小
        thumbnailWidth = 190 * ratio,
        thumbnailHeight = 220 * ratio,

        // Web Uploader实例
        uploader;

    // 初始化Web Uploader
    uploader = WebUploader.create({

        // 自动上传。
        auto: true,

        // swf文件路径
        swf: BASE_URL + '/Uploader.swf',

        // 文件接收服务端。
        //server: '/template/default/qq3479015851/upload/fileupload1111.php',
		server: '/qq3479015851.php',
        // 选择文件的按钮。可选。
        // 内部根据当前运行是创建，可能是input元素，也可能是flash.
        pick: '#filePicker',
		
		//文件选择的数量
		fileNumLimit: parseInt($('#uploadNumLimit').val()),

        // 只允许选择文件，可选。
        accept: {
            title: 'Images',
            extensions: 'jpg,jpeg,png',
            mimeTypes: 'image/jpg,image/jpeg,image/png'
        }
    });

	
    // 当有文件添加进来的时候
    uploader.on( 'fileQueued', function( file ) {
	var TPN = parseInt($('#totalPicNum').val())+1;
    $('#totalPicNum').val(TPN);
	if(TPN==1){
	   var $li = $(
                '<div id="' + file.id + '" class="file-item thumbnail">' +
                    '<img>' +
					''+
					'<input type="hidden" name="images[]" form="form1" orderid="'+file.realid+'" id="qq3479015851_'+file.id+'">'+
                    '<span class="postimg-item-status_qq3479015851 ">'+
					'<input type="button" onclick="qianyi(\''+file.id+'\')" class="postimg-item-move-backward status-button" value="前移">'+
					'<input type="button" onclick="feng(\''+file.id+'\')" id="cover_'+file.id+'" disabled class="cover status-button" value="当前封面">'+
					'<a class="postimg-status-del" onclick="delObj(\''+file.id+'\')" href="javascript:void(0)" title="删除这张照片">x</a>'+
					'<input type="button" onclick="houyi(\''+file.id+'\')" class="postimg-item-move-forward status-button" value="后移">'+
                '</div>'
                ),
            $img = $li.find('img');
	}else{
	   var $li = $(
                '<div id="' + file.id + '" class="file-item thumbnail">' +
                    '<img>' +
					'<input type="hidden" name="images[]" form="form1" orderid="'+file.realid+'" id="qq3479015851_'+file.id+'">'+
                    '<span class="postimg-item-status_qq3479015851 ">'+
					'<input type="button" onclick="qianyi(\''+file.id+'\')" class="postimg-item-move-backward status-button" value="前移">'+
					'<input type="button" onclick="feng(\''+file.id+'\')" id="cover_'+file.id+'" class="cover status-button" value="设为封面">'+
					'<a class="postimg-status-del" onclick="delObj(\''+file.id+'\')" href="javascript:void(0)" title="删除这张照片">x</a>'+
					'<input type="button" onclick="houyi(\''+file.id+'\')" class="postimg-item-move-forward status-button" value="后移">'+
                '</div>'
                ),
            $img = $li.find('img');
	}		
			
		//	

        $list.append( $li );

        // 创建缩略图
        uploader.makeThumb( file, function( error, src ) {
            if ( error ) {
                $img.replaceWith('<span>不能预览</span>');
                return;
            }

            $img.attr( 'src', src );
        }, thumbnailWidth, thumbnailHeight );
    });

    // 文件上传过程中创建进度条实时显示。
    uploader.on( 'uploadProgress', function( file, percentage ) {
        var $li = $( '#'+file.id ),
            $percent = $li.find('.progress span');

        // 避免重复创建
        if ( !$percent.length ) {
            $percent = $('<p class="progress"><span></span></p>')
                    .appendTo( $li )
                    .find('span');
        }

        $percent.css( 'width', percentage * 100 + '%' );
    });

    // 文件上传成功，给item添加成功class, 用样式标记上传成功。
    uploader.on( 'uploadSuccess', function( file,response ) {
		//console.log(response);
        //$( '#'+file.id ).addClass('upload-state-done');
		$( '#qq3479015851_'+file.id ).val(response.qq3479015851);
		//console.log(response.result);
    });

    // 文件上传失败，显示上传出错。
    uploader.on( 'uploadError', function(file,response) {
        var $li = $( '#'+file.id ),
            $error = $li.find('div.error');

        // 避免重复创建
        if ( !$error.length ) {
            $error = $('<div class="error"></div>').appendTo( $li );
        }

        $error.text('上传失败');
    });

    // 完成上传完了，成功或者失败，先删除进度条。
    uploader.on( 'uploadComplete', function( file ) {
        $( '#'+file.id ).find('.progress').remove();
    });	
});


function qianyi(obj){
	var objTotalNum = $("div.thumbnail").length;//获取图片的总个数
	var firstObj = $("div.thumbnail:first");
	var lastObj = $("div.thumbnail:last");
	//console.log(firstObj.attr("id"));
	//console.log(lastObj.attr("id"));
	var preobj = $('#'+obj).prev();
	var curobj = $('#'+obj);
	
	if(curobj.is(firstObj)){
		//console.log("first::::");
		var curid=curobj.attr("id");
		var coverobj=$("#cover_"+curid);
		//console.log(coverobj.val());
		coverobj.removeAttr("disabled");
		coverobj.val("设为封面");
		var nextobj = curobj.next();
		var nextid = nextobj.attr("id");
		//console.log(nextid);
		var nextcoverobj = $("#cover_"+nextid);
		nextcoverobj.attr("disabled","");
		nextcoverobj.val("当前封面");
		
		preobj =lastObj;
		curobj.insertAfter(preobj);

		return false;
	}
	
	if(preobj.is(firstObj)){
 		var preid=preobj.attr("id");
		var precoverobj=$("#cover_"+preid);
		//console.log(coverobj.val());
		precoverobj.removeAttr("disabled");
		precoverobj.val("设为封面");
		
		var curid=curobj.attr("id");
		var coverobj=$("#cover_"+curid);
		//console.log(coverobj.val());
		coverobj.attr("disabled","");
		coverobj.val("当前封面"); 
		
	}
		
	curobj.insertBefore(preobj);
	
}


function houyi(obj){
	var objTotalNum = $("div.thumbnail").length;//获取图片的总个数
	var firstObj = $("div.thumbnail:first");
	var lastObj = $("div.thumbnail:last");
	//console.log(firstObj.attr("id"));
	//console.log(lastObj.attr("id"));
	var nextobj = $('#'+obj).next();
	var curobj = $('#'+obj);
	
	if(curobj.is(lastObj)){
		//console.log("first::::");
		
		var curid=curobj.attr("id");
		var coverobj=$("#cover_"+curid);
		//console.log(coverobj.val());
		coverobj.attr("disabled","");
		coverobj.val("当前封面");
		
		var firstid=firstObj.attr("id");
		var firstcoverobj=$("#cover_"+firstid);
		//console.log(coverobj.val());
		firstcoverobj.removeAttr("disabled");
		firstcoverobj.val("设为封面");
		
		
		nextobj =firstObj;
		curobj.insertBefore(nextobj);
		return false;
	}

	
	if(curobj.is(firstObj)){
		var curid=curobj.attr("id");
		var coverobj=$("#cover_"+curid);
		//console.log(coverobj.val());
		coverobj.removeAttr("disabled","");
		coverobj.val("设为封面"); 
		
 		var nextid=nextobj.attr("id");
		var nextcoverobj=$("#cover_"+nextid);
		//console.log(coverobj.val());
		nextcoverobj.attr("disabled","");
		nextcoverobj.val("当前封面");
		
	}
	
	
	
	
	curobj.insertAfter(nextobj);
	
}


function feng(obj){
	var firstObj = $("div.thumbnail:first");
	var curobj = $('#'+obj);
	if(curobj.is(firstObj)){
		return false;
	}
	var curid=curobj.attr("id");
	var coverobj=$("#cover_"+curid);
	//console.log(coverobj.val());
	coverobj.attr("disabled","");
	coverobj.val("当前封面");
	
	var firstid=firstObj.attr("id");
	var firstcoverobj=$("#cover_"+firstid);
	//console.log(coverobj.val());
	firstcoverobj.removeAttr("disabled");
	firstcoverobj.val("设为封面");
	
	curobj.insertBefore(firstObj);
}

function delObj(obj){
	var objTotalNum = $("div.thumbnail").length;//获取图片的总个数
	if(objTotalNum==1){
		$('#'+obj).remove();
		$('#totalPicNum').val(0);
		return false;
	}
	var nextobj = $('#'+obj).next();
	var nextid=nextobj.attr("id");
	var nextcoverobj=$("#cover_"+nextid);
	//console.log(coverobj.val());
	nextcoverobj.attr("disabled","");
	nextcoverobj.val("当前封面");
	$('#'+obj).remove();
	$('#totalPicNum').val(objTotalNum-1);
}








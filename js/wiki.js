$(function(){
    // 替换外网连接
    $("a[href^='http://']").each(function(){
      this.target = "_blank";
    });

    $("a[href^='https://']").each(function(){
      this.target = "_blank";
    });
    // 替换表格样式
    $("table").addClass("table table-bordered table-striped table-hover");
});


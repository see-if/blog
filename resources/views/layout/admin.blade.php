<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>liner 的后台</title>
	<meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />

    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
    @include('admin.public.style')
    @include('admin.public.script')

</head>
<body>
    <!-- 顶部开始 -->
    @include('admin.public.header')
    <!-- 顶部结束 -->
    
    <!-- 中部开始 -->
    @include('admin.public.aside')
    <!-- 中部结束 -->

    <!-- 底部开始 -->
    @include('admin.public.footer')
    <!-- 底部结束 -->
    
</body>
</html>
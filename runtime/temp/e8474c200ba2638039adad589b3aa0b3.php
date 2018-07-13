<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:46:"C:\wamp64\www\pay/app/demo\view\pay.index.html";i:1531467658;s:51:"C:\wamp64\www\pay\app\extra\view\admin.content.html";i:1531455603;}*/ ?>
<div class="ibox">
    
    <?php if(isset($title)): ?>
    <div class="ibox-title notselect">
        <h5><?php echo $title; ?></h5>
        
    </div>
    <?php endif; ?>
    <div class="ibox-content">
        <?php if(isset($alert)): ?>
        <div class="alert alert-<?php echo $alert['type']; ?> alert-dismissible" role="alert" style="border-radius:0">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <?php if(isset($alert['title'])): ?><p style="font-size:18px;padding-bottom:10px"><?php echo $alert['title']; ?></p><?php endif; if(isset($alert['content'])): ?><p style="font-size:14px"><?php echo $alert['content']; ?></p><?php endif; ?>
        </div>
        <?php endif; ?>
        
<form class="layui-form layui-box" style='padding:25px 30px 20px 0' action="__SELF__" data-auto="true" method="post">

 <div class="layui-form-item">
        <label class="layui-form-label">appId</label>
        <div class="layui-input-block">
             
            <select  name="appId" value='6'
                   required="required" title="appId" placeholder="appId" class="layui-input">


                <option value="6">支付宝</option>
                <option value="5">微信</option>
            </select>
             
        </div>
    </div>
	
	
	 <div class="layui-form-item">
        <label class="layui-form-label">订单金额</label>
        <div class="layui-input-block">
             
            <input  name="orderMoney" value='0.01'
                   required="required" title="订单金额" placeholder="订单金额" class="layui-input"> 
             
        </div>
    </div>
	
	 <div class="layui-form-item">
        <label class="layui-form-label">时间戳</label>
        <div class="layui-input-block">
             
            <input  name="orderDate" value='<?php echo $time; ?>'
                   required="required" title="时间戳" placeholder="时间戳" class="layui-input"> 
             
        </div>
    </div>
	
	
		
	 <div class="layui-form-item">
        <label class="layui-form-label">订单号</label>
        <div class="layui-input-block">
             
            <input  name="orderId" value='<?php echo $time; ?>'
                   required="required" title="订单号" placeholder="订单号" class="layui-input"> 
             
        </div>
    </div>
	
	 <div class="layui-form-item">
        <label class="layui-form-label">同步回调</label>
        <div class="layui-input-block">
             
            <input  name="returnUrl" value='http://www.baidu.com'
                   required="required" title="同步回调" placeholder="同步回调" class="layui-input"> 
             
        </div>
    </div>
	
	
	<div class="layui-form-item">
        <label class="layui-form-label">异步回调</label>
        <div class="layui-input-block">
             
            <input  name="notifyUrl" value='http://www.baidu.com'
                   required="required" title="异步回调" placeholder="异步回调" class="layui-input"> 
             
        </div>
    </div>
	
	
	<div class="layui-form-item">
        <label class="layui-form-label">产品名称</label>
        <div class="layui-input-block">
             
            <input  name="productName" value='测试'
                   required="required" title="产品名称" placeholder="产品名称" class="layui-input"> 
             
        </div>
    </div>
	
	 <div class="layui-form-item">
        <label class="layui-form-label">银行信息</label>
        <div class="layui-input-block">
             
            <input  name="bank" value='{}'
                   required="required" title="订单金额" placeholder="订单金额" class="layui-input"> 
             
        </div>
    </div>
	
    <div class="layui-form-item">
        <label class="layui-form-label">key</label>
        <div class="layui-input-block">
             
            <select  name="key" value='WEmUZltnEfmN8cZKayQkX8S8ejzgdUTi'
                     required="required" title="key" placeholder="key" class="layui-input">
                <option value="WEmUZltnEfmN8cZKayQkX8S8ejzgdUTi">支付宝key</option>
                <option value="t7URYMbDh4ViAR7rCuc8CN90h7s7Pj361">微信key</option>

            </select>
            
             
        </div>
    </div>

    

  
 

    <div class="layui-form-item text-center">
     
        <button class="layui-btn" type='submit'><i class="fa fa-floppy-o"></i> 保存数据</button>
        <button class="layui-btn layui-btn-danger" type='button' data-confirm="确定要取消提交吗？" data-close><i class="fa fa-close"></i> 取消编辑</button>
    </div>
    <script>window.form.render();</script>
</form>
 

 

    </div>
    
</div>
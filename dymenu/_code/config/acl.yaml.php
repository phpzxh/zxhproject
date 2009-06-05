# <?php die(); ?>

## 注意：书写时，缩进不能使用 Tab，必须使用空格。并且各条访问规则之间不能留有空行。

#############################
# 访问规则
#############################

# 访问规则示例
#
default:
  allow:  ACL_EVERYONE
bodashboard:
  allow:  ACL_HAS_ROLE
bosettings:
  allow:  'ROOT, 前台功能设置, 商品相关设置, VIP升级设置, 会员级别变更通知设置, 用户注册默认设置, 违约用户检查, 送货方式设置, 付款方式设置, 退款方式设置'
bosysusers:
  allow:  'ROOT, 后台用户管理'
bodelivermethods:
  allow:  'ROOT, 送货方式设置'
bopaymentmethods:
  allow:  'ROOT, 付款方式设置'
borefundmentmethods:
  allow:  'ROOT, 退款方式设置'
boproducts:
  allow:  'ROOT, 添加商品, 列出商品, 商品审核, 商品图片管理, 修改商品, 删除商品'
  actions:
    index:
      allow:  'ROOT, 列出商品'
    add:
      allow:  'ROOT, 添加商品'
    edit:
      allow:  'ROOT, 列出商品, 修改商品'
    publish:
      allow:  'ROOT, 商品审核'
    delete:
      allow:  'ROOT, 删除商品'
    save:
      allow:  'ROOT, 添加商品, 修改商品'
    displayPhotoManager:
      allow:  'ROOT, 商品图片管理'
    displayThumbManager:
      allow:  'ROOT, 商品图片管理'
    upload:
      allow:  'ROOT, 商品图片管理'
    removePhotos:
      allow:  'ROOT, 商品图片管理'
    setPhotosVipOnly:
      allow:  'ROOT, 商品图片管理'
    uploadSmallPhoto:
      allow:  'ROOT, 商品图片管理'
    removeSmallPhoto:
      allow:  'ROOT, 商品图片管理'
      
boorders:
  allow:  'ROOT, 修改订单, 列出并查看所有订单, 删除订单, 确认发货, 确认订单'
  actions:
    index:
      allow:  'ROOT, 列出并查看所有订单'
    save:
      allow:  'ROOT, 修改订单'
    delete:
      allow:  'ROOT, 删除订单'
    confirm:
      allow:  'ROOT, 确认订单'
    cancelConfirm:
      allow:  'ROOT, 确认订单'
    process:
      allow:  'ROOT, 确认发货'
bomembers:
  allow:  'ROOT, 导出会员资料, 列出会员, 修改会员, 审核会员, 删除会员'
  actions:
    index:
      allow:  'ROOT, 列出会员'
    export:
      allow:  'ROOT, 导出会员资料'
    edit:
      allow:  'ROOT, 列出会员, 修改会员'
    save:
      allow:  'ROOT, 修改会员'
    delete:
      allow:  'ROOT, 删除会员'
boupgrade:
  allow:  'ROOT, 审核VIP升级'
  
bonews:
  allow:  'ROOT, 发布新闻, 列出及修改新闻'
  actions:
    index:
      allow:  'ROOT, 列出及修改新闻'
    edit:
      allow:  'ROOT, 列出及修改新闻'
    save:
      allow:  'ROOT, 列出及修改新闻'
    add:
      allow:  'ROOT, 发布新闻'
      
botags:
  allow:  'ROOT, 标签管理'
botagtypes:
  allow:  'ROOT, 标签类别管理'
  
bomessages:
  allow:  'ROOT, 查看会员消息, 查看管理员发送的消息, 向会员发送消息, 群发消息, 删除消息'
  actions:
    index:
      allow:  'ROOT, 查看会员消息'
    view:
      allow:  'ROOT, 查看会员消息'
    send:
      allow:  'ROOT, 向会员发送消息'
    save:
      allow:  'ROOT, 向会员发送消息'
    reply:
      allow:  'ROOT, 向会员发送消息'
    delete:
      allow:  'ROOT, 删除消息'
    sendMessagesToGroup:
      allow:  'ROOT, 群发消息'
    outbox:
      allow:  'ROOT, 查看管理员发送的消息'
    emptyOutbox:
      allow:  'ROOT, 查看管理员发送的消息'
    viewOutbox:
      allow:  'ROOT, 查看管理员发送的消息'
      
bolocations:
  allow:  'ROOT, 商品地区管理'
  
boonlineusers:
  allow:  ACL_HAS_ROLE

      

<?php
// +----------------------------------------------------------------------
// | likeshop100%开源免费商用商城系统
// +----------------------------------------------------------------------
// | 欢迎阅读学习系统程序代码，建议反馈是我们前进的动力
// | 开源版本可自由商用，可去除界面版权logo
// | 商业版本务必购买商业授权，以免引起法律纠纷
// | 禁止对系统程序代码以任何目的，任何形式的再发布
// | gitee下载：https://gitee.com/likeshop_gitee
// | github下载：https://github.com/likeshop-github
// | 访问官网：https://www.likeshop.cn
// | 访问社区：https://home.likeshop.cn
// | 访问手册：http://doc.likeshop.cn
// | 微信公众号：likeshop技术社区
// | likeshop团队 版权所有 拥有最终解释权
// +----------------------------------------------------------------------
// | author: likeshopTeam
// +----------------------------------------------------------------------

namespace app\adminapi\controller\auth;

use app\adminapi\controller\BaseAdminController;
use app\adminapi\lists\auth\AdminLists;
use app\adminapi\validate\auth\AdminValidate;
use app\adminapi\logic\auth\AdminLogic;

/**
 * 管理员控制器
 * Class AdminController
 * @package app\adminapi\controller\auth
 */
class AdminController extends BaseAdminController
{

    /**
     * @notes 查看管理员列表
     * @return \think\response\Json
     * @author 段誉
     * @date 2021/12/29 9:55
     */
    public function lists()
    {
        return $this->dataLists(new AdminLists());
    }


    /**
     * @notes 添加管理员
     * @return \think\response\Json
     * @author 段誉
     * @date 2021/12/29 10:21
     */
    public function add()
    {
        $params = (new AdminValidate())->post()->goCheck('add');
        AdminLogic::add($params);
        return $this->success('添加成功', [], 1, 1);
    }


    /**
     * @notes 编辑管理员
     * @return \think\response\Json
     * @author 段誉
     * @date 2021/12/29 11:03
     */
    public function edit()
    {
        $params = (new AdminValidate())->post()->goCheck('edit');
        $result = AdminLogic::edit($params);
        if (true === $result) {
            return $this->success('编辑成功', [], 1, 1);
        }
        return $this->fail(AdminLogic::getError());
    }


    /**
     * @notes 删除管理员
     * @return \think\response\Json
     * @author 段誉
     * @date 2021/12/29 11:03
     */
    public function delete()
    {
        $params = (new AdminValidate())->post()->goCheck('delete');
        $result = AdminLogic::delete($params);
        if (true === $result) {
            return $this->success('删除成功', [], 1, 1);
        }
        return $this->fail(AdminLogic::getError());
    }


    /**
     * @notes 查看管理员详情
     * @return \think\response\Json
     * @author 段誉
     * @date 2021/12/29 11:07
     */
    public function detail()
    {
        $params = (new AdminValidate())->goCheck('detail');
        $result = AdminLogic::detail($params);
        return $this->data($result);
    }


    /**
     * @notes 获取当前管理员信息
     * @return \think\response\Json
     * @author 段誉
     * @date 2021/12/31 10:53
     */
    public function mySelf()
    {
        $result = AdminLogic::detail(['id' => $this->adminId]);
        return $this->data($result);
    }

}
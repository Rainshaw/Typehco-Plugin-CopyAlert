<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

/**
 * No Copy
 *
 * @package CopyAlert
 * @author 日月明
 * @version 1.0.0
 * @link https://www.ruixiaolu.com/archives/478/
 */

class CopyAlert_Plugin implements Typecho_Plugin_Interface {
    /**
     * 激活插件方法,如果激活失败,直接抛出异常
     *
     * @access public
     * @return void
     * @throws Typecho_Plugin_Exception
     */
    public static function activate(){
        #Typecho_Plugin::factory('admin/menu.php')->navBar = array('HelloWorld_Plugin', 'render');
        Typecho_Plugin::factory('Widget_Archive')->footer = array('CopyAlert_Plugin', 'render');
    }

    /**
     * 禁用插件方法,如果禁用失败,直接抛出异常
     *
     * @static
     * @access public
     * @return void
     * @throws Typecho_Plugin_Exception
     */
    public static function deactivate(){}

    /**
     * 获取插件配置面板
     *
     * @access public
     * @param Typecho_Widget_Helper_Form $form 配置面板
     * @return void
     */
    public static function config(Typecho_Widget_Helper_Form $form)
    {
        /** 分类名称 */
        $word = new Typecho_Widget_Helper_Form_Element_Text('word', NULL, '复制成功，若要转载请务必保留原文链接！', _t('弹窗内容'), _t('即读者执行复制操作后，网页的提示内容'));
        $form->addInput($word);
    }

    /**
     * 个人用户的配置面板
     *
     * @access public
     * @param Typecho_Widget_Helper_Form $form
     * @return void
     */
    public static function personalConfig(Typecho_Widget_Helper_Form $form){}

    /**
     * 插件实现方法
     *
     * @access public
     * @return void
     */
    public static function render() {
        $options = Typecho_Widget::widget('Widget_Options')->plugin('CopyAlert');
        echo "<script src=\"https://lib.baomitu.com/layer/3.1.1/layer.js\"></script>";
        echo "<script type=\"text/javascript\">document.body.oncopy = function() {layer.msg('".htmlspecialchars($options->word)."', function(){});};</script>";
    }
}
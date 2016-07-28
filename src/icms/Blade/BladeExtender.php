<?php
namespace ICMS\Blade;

class BladeExtender {
	public static function directiveStartContent($value)
	{
		$expression = $this->stripParentheses('layouts.base.admin');

		$data = "<?php echo \$__env->make($expression, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>";
		$this->footer[] = $data;

		$expression = 'content';
		return "<?php \$__env->startSection{$expression}; ?>";
	}

	public static function directiveEndContent($value, $pattern, $replacement)
	{
		return '<?php $__env->stopSection(); ?>';
	}
}
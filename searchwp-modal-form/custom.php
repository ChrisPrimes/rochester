<?php
/**
 * SearchWP Modal Form Name: Custom
 */

// The above comment block is REQUIRED to register this modal search form
// template with SearchWP Modal Form. This template file must also be placed
// in an applicable folder as outlined in the documentation.
// More info: https://searchwp.com/extensions/modal-form/#templates
?>

<?php
/**
 * This is the default markup for a SearchWP Modal Form. The structure is intended
 * to allow for rapid customization, based on WordPress' get_search_form() to output
 * the form markup.
 *
 * When creating your own custom modal search form templates, you should use a unique
 * namespace, replacing all occurrences of `searchwp-modal-form-default` with your own.
 *
 * You can tell the SearchWP Modal Form to close when an element is clicked by adding
 * the `data-searchwp-modal-form-close` attribute which has been added to both the
 * overlay and the close button in the footer in the default markup.
 *
 * See notes above the <style/> block below the markup for further documentation.
 *
 * More info: https://searchwp.com/extensions/modal-form/#templates
 */
?>
<div class="searchwp-modal-form-default">
	<div class="searchwp-modal-form__overlay" tabindex="-1" data-searchwp-modal-form-close>
		<div class="searchwp-modal-form__container" role="dialog" aria-modal="true">
			<div class="searchwp-modal-form__content">
				<?php echo get_search_form(); ?>
			</div>
			<footer class="searchwp-modal-form__footer">
				<button class="searchwp-modal-form__close button" aria-label="Close" data-searchwp-modal-form-close></button>
			</footer>
		</div>
	</div>
</div>
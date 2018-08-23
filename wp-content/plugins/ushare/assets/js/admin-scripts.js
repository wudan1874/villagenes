var entityMap = {
	"&": "&amp;",
	"<": "&lt;",
	">": "&gt;",
	'"': '&quot;',
	"'": '&#39;',
	"/": '&#x2F;'
};

function escapeHtml(string) {
	return String(string).replace(/[&<>"'\/]/g, function (s) {
  		return entityMap[s];
	});
}

(function($) {
	"use strict";
	function update_networks_sort() {
		var $networks_html = '',
			count = 0;

		$('#active-networks .left-group .u-network').each(function(index, el) {

			$networks_html += '<input type="hidden" name="ushare_settings[networks_sort][left]['+ count +'][network]" value="'+ $(this).data('network') +'">';
			$networks_html += '<input type="hidden" name="ushare_settings[networks_sort][left]['+ count +'][style]" value="'+ $(this).data('style') +'">';
			$networks_html += '<input type="hidden" name="ushare_settings[networks_sort][left]['+ count +'][icon]" value="'+ $(this).data('icon') +'">';
			$networks_html += '<input type="hidden" name="ushare_settings[networks_sort][left]['+ count +'][label]" value="'+ $(this).data('label') +'">';
			
			count += 1;
		});

		count = 0;
		$('#active-networks .middle-group .u-network').each(function(index, el) {

			$networks_html += '<input type="hidden" name="ushare_settings[networks_sort][middle]['+ count +'][network]" value="'+ $(this).data('network') +'">';
			$networks_html += '<input type="hidden" name="ushare_settings[networks_sort][middle]['+ count +'][style]" value="'+ $(this).data('style') +'">';
			$networks_html += '<input type="hidden" name="ushare_settings[networks_sort][middle]['+ count +'][icon]" value="'+ $(this).data('icon') +'">';
			$networks_html += '<input type="hidden" name="ushare_settings[networks_sort][middle]['+ count +'][label]" value="'+ $(this).data('label') +'">';
			
			count += 1;
		});

		count = 0;
		$('#active-networks .right-group .u-network').each(function(index, el) {

			$networks_html += '<input type="hidden" name="ushare_settings[networks_sort][right]['+ count +'][network]" value="'+ $(this).data('network') +'">';
			$networks_html += '<input type="hidden" name="ushare_settings[networks_sort][right]['+ count +'][style]" value="'+ $(this).data('style') +'">';
			$networks_html += '<input type="hidden" name="ushare_settings[networks_sort][right]['+ count +'][icon]" value="'+ $(this).data('icon') +'">';
			$networks_html += '<input type="hidden" name="ushare_settings[networks_sort][right]['+ count +'][label]" value="'+ $(this).data('label') +'">';
			
			count += 1;
		});

		count = 0;
		$('#active_notification_networks .u-network').each(function(index, el) {

			$networks_html += '<input type="hidden" name="ushare_settings[networks_sort][notification]['+ count +'][network]" value="'+ $(this).data('network') +'">';
			$networks_html += '<input type="hidden" name="ushare_settings[networks_sort][notification]['+ count +'][style]" value="'+ $(this).data('style') +'">';
			$networks_html += '<input type="hidden" name="ushare_settings[networks_sort][notification]['+ count +'][icon]" value="'+ $(this).data('icon') +'">';
			$networks_html += '<input type="hidden" name="ushare_settings[networks_sort][notification]['+ count +'][label]" value="'+ $(this).data('label') +'">';
			
			count += 1;
		});

		count = 0;
		$('#active_sharemore .u-network').each(function(index, el) {

			$networks_html += '<input type="hidden" name="ushare_settings[networks_sort][more]['+ count +'][network]" value="'+ $(this).data('network') +'">';
			$networks_html += '<input type="hidden" name="ushare_settings[networks_sort][more]['+ count +'][icon]" value="'+ $(this).data('icon') +'">';
			
			count += 1;
		});

		$('#networks_sort_hidden').html($networks_html);
	}
	update_networks_sort();

	$('#inactive-networks .block').each(function() {
		$(this).usortable({
			group: {name: "networks", pull: 'clone', put: false},
			draggable: ".u-network",
			sort: false,
			ghostClass: "sortable-ghost",
			// scroll: true,
    		// scrollSensitivity: 100
		});
	}); 
	$('#active-networks .left-group').usortable({
		group: {name: "networks", pull: true},
		draggable: ".u-network",
		ghostClass: "sortable-ghost",
		dataIdAttr: 'data-id',
		filter: '.js-remove',
		onFilter: function (evt) {
			evt.item.parentNode.removeChild(evt.item);
			update_networks_sort();
		},
	    // Called by any change to the list (add / update / remove)
	    onSort: function (evt) {
	        // same properties as onUpdate
	        update_networks_sort();
	    }
	});
	$('#active-networks .middle-group').usortable({
		group: {name: "networks", pull: true},
		draggable: ".u-network",
		ghostClass: "sortable-ghost",
		dataIdAttr: 'data-id',
		filter: '.js-remove',
		onFilter: function (evt) {
			evt.item.parentNode.removeChild(evt.item);
			update_networks_sort();
		},
		// Called by any change to the list (add / update / remove)
	    onSort: function (evt) {
	        // same properties as onUpdate
	        update_networks_sort();
	    },
	});
	$('#active-networks .right-group').usortable({
		group: {name: "networks", pull: true},
		draggable: ".u-network",
		ghostClass: "sortable-ghost",
		dataIdAttr: 'data-id',
		filter: '.js-remove',
		onFilter: function (evt) {
			evt.item.parentNode.removeChild(evt.item);
			update_networks_sort();
		},
		// Called by any change to the list (add / update / remove)
	    onSort: function (evt) {
	        // same properties as onUpdate
	        update_networks_sort();
	    },
	});

	$('#active_notification_networks').usortable({
		group: {name: "networks", pull: true},
		draggable: ".u-network",
		ghostClass: "sortable-ghost",
		dataIdAttr: 'data-id',
		filter: '.js-remove',
		onFilter: function (evt) {
			evt.item.parentNode.removeChild(evt.item);
			update_networks_sort();
		},
		// Called by any change to the list (add / update / remove)
	    onSort: function (evt) {
	        // same properties as onUpdate
	        update_networks_sort();
	    },
	});

	$('#active_sharemore').usortable({
		group: {name: "networks", pull: true},
		draggable: ".u-network",
		ghostClass: "sortable-ghost",
		dataIdAttr: 'data-id',
		filter: '.js-remove',
		onFilter: function (evt) {
			evt.item.parentNode.removeChild(evt.item);
			update_networks_sort();
		},
		// Called by any change to the list (add / update / remove)
	    onSort: function (evt) {
	        // same properties as onUpdate
	        update_networks_sort();
	    },
	});
	function update_network_style() {

		var style = $('#network_style').val(),
			radius = $('#network_radius').val(),
			data_style = '';

		if( style == 'flat' ) {
            $('#inactive-networks .u-network').removeClass('style-plain');
            $('#inactive-networks .u-network').removeClass('style-reverse');

            $('#inactive-networks .u-network').addClass('style-flat');
            data_style += 'style-flat';
		} else if( style == 'reverse' ) {
			$('#inactive-networks .u-network').removeClass('style-flat');
			$('#inactive-networks .u-network').removeClass('style-plain');

            $('#inactive-networks .u-network').addClass('style-reverse');
            data_style += 'style-reverse';
		} else {
			$('#inactive-networks .u-network').removeClass('style-flat');
			$('#inactive-networks .u-network').removeClass('style-reverse');
			
            $('#inactive-networks .u-network').addClass('style-plain');
            data_style += 'style-plain';
		}

		if( 'rounded' == radius ) {
            $('#inactive-networks .u-network').removeClass('sharp');
            $('#inactive-networks .u-network').addClass('rounded');
            data_style += ' rounded';
		} else if('sharp' == radius) {
			$('#inactive-networks .u-network').removeClass('rounded');
            $('#inactive-networks .u-network').addClass('sharp');
            data_style += ' sharp';
		} else {
			$('#inactive-networks .u-network').removeClass('sharp');
			$('#inactive-networks .u-network').removeClass('rounded');
		}

		$('#inactive-networks .u-network').attr('data-style', data_style);
	}

	$('#network_style').change(function(event) {
		update_network_style();
	});
	$('#network_radius').change(function(event) {
		update_network_style();
	});

	// 吸附侧栏拖拽
	function update_side_networks_sort() {
		var $networks_html = '',
			count = 0;

		$('#active_side_networks .u-network').each(function(index, el) {

			$networks_html += '<input type="hidden" name="ushare_settings[side_networks_sort]['+ count +'][network]" value="'+ $(this).data('network') +'">';
			$networks_html += '<input type="hidden" name="ushare_settings[side_networks_sort]['+ count +'][icon]" value="'+ $(this).data('icon') +'">';
			$networks_html += '<input type="hidden" name="ushare_settings[side_networks_sort]['+ count +'][style]" value="'+ $(this).data('style') +'">';
			count += 1;
		});

		$('#side_networks_hidden').html($networks_html);
	}
	update_side_networks_sort();

	$('#inactive_side_networks').usortable({
		group: {name: "side_networks", pull: true},
		draggable: ".u-network",
		ghostClass: "sortable-ghost",
		dataIdAttr: 'data-id',
		filter: '.js-remove',
		onFilter: function (evt) {
			evt.item.parentNode.removeChild(evt.item);
			update_networks_sort();
		},
	    // Called by any change to the list (add / update / remove)
	    onSort: function (evt) {
	        // same properties as onUpdate
	        update_side_networks_sort();
	    }
	});
	$('#active_side_networks').usortable({
		group: {name: "side_networks", pull: true},
		draggable: ".u-network",
		ghostClass: "sortable-ghost",
		dataIdAttr: 'data-id',
		filter: '.js-remove',
		onFilter: function (evt) {
			evt.item.parentNode.removeChild(evt.item);
			update_side_networks_sort();
		},
		// Called by any change to the list (add / update / remove)
	    onSort: function (evt) {
	        // same properties as onUpdate
	        update_side_networks_sort();
	    },
	});
})(jQuery);
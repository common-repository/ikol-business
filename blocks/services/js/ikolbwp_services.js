(function (blocks, editor, element, components) {
	const {__}                                    = wp.i18n;
	const el                                      = element.createElement;
	const {InspectorControls, PanelColorSettings} = editor;
	const {Fragment}                              = element;
	const {PanelBody, TextControl, SelectControl} = components;

	blocks.registerBlockType(
		'ikolbwp/services',
		{
			title: __( 'IKOL Services List', 'ikolbwp' ),
			icon: 'cart',
			category: 'widgets',
			keywords: ['ikol', 'ikol-business', 'services', 'reservation'],
			attributes: {
				display_mode: {
					type: 'string',
					default: 'default',
				},
				acquisition: {
					type: 'string',
					default: null,
				},
			},
			example: {
				attributes: {
					acquisition: null,
					display_mode: 'tiles',
				},
			},
			edit: (function (props) {
				const styles = {
					'height': '500px',
					'display': 'flex',
					'justify-content': 'center',
					'text-align': 'center',
					'align-items': 'center',
					'border': '1px solid #000',
				};

				return [
				el(
					Fragment,
					{},
					el(
						InspectorControls,
						{},
						[
						el(
							PanelBody,
							{title: __( 'General', 'ikolbwp' ), initialOpen: true},
							el(
								SelectControl,
								{
									label: __( 'Display mode', 'ikolbwp' ),
									help: __( 'You can define which layout your service list will be displayed with.', 'ikolbwp' ),
									value: props.attributes.display_mode,
									options: [
									{ value: 'default', label: __( 'Default', 'ikolbwp' ) },
									{ value: 'tiles', label: __( 'Tiles', 'ikolbwp' ) },
									{ value: 'list', label: __( 'List', 'ikolbwp' ) },
									],
									onChange: (value) => {
										props.setAttributes( {display_mode: value} );
									},
								}
							),
						),
						el(
							PanelBody,
							{title: __( 'Acquisition source', 'ikolbwp' ), initialOpen: false},
							el(
								TextControl,
								{
									label: __( 'Tag', 'ikolbwp' ),
									help: __( 'You can define text tag to mark incoming leads or reservations from this IKOL service form.', 'ikolbwp' ),
									value: props.attributes.acquisition,
									onChange: (value) => {
										if (String( value ).trim()) {
											props.setAttributes( {acquisition: value} );
										} else {
											props.setAttributes( {acquisition: null} );
										}
									},
								}
							),
						),
						]
					),
				),
				el(
					'div',
					{className: props.className, style: styles},
					__( 'Your IKOL Service list will be displayed here', 'ikolbwp' )
				)
				];
			}),
		save: function (props) {
			const styles = {};
			const attrs  = {
				'data-ikol-services': true,
				'data-acquisition': props.attributes.acquisition,
			};

			if (props.attributes.display_mode !== 'default') {
				attrs['data-display-mode'] = props.attributes.display_mode;
			}

			return (
			el(
				'div',
				{className: props.className, style: styles},
				el( 'div', attrs )
			)
			);
		},
		}
	);
})( wp.blocks, wp.editor, wp.element, wp.components );

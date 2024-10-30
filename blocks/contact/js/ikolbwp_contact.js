(function (blocks, editor, element, components) {
	const {__}                                    = wp.i18n;
	const el                                      = element.createElement;
	const {InspectorControls, PanelColorSettings} = editor;
	const {Fragment}                              = element;
	const {PanelBody, TextControl}                = components;

	blocks.registerBlockType(
		'ikolbwp/contact',
		{
			title: __( 'IKOL Contact Form', 'ikolbwp' ),
			icon: 'format-chat',
			category: 'widgets',
			keywords: ['ikol', 'ikol-business', 'contact'],
			attributes: {
				backgroundColor: {
					type: 'string',
					default: "#FFFFFF",
				},
				acquisition: {
					type: 'string',
					default: null,
				},
			},
			example: {
				attributes: {
					backgroundColor: "#FFFFFF",
					acquisition: null,
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
					'background-color': props.attributes.backgroundColor
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
							{title: __( 'Background settings', 'ikolbwp' ), initialOpen: true},
							el(
								PanelColorSettings,
								{
									colorSettings: [
									{
										value: props.attributes.backgroundColor,
										label: __( 'Background color', 'ikolbwp' ),
										onChange: (value) => {
											props.setAttributes( {backgroundColor: value} );
										},
									},
									]
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
									help: __( 'You can define text tag to mark incoming leads from this IKOL contact form instance.', 'ikolbwp' ),
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
					__( 'Your IKOL Contact form will be displayed here', 'ikolbwp' )
				)
				];
			}),
		save: function (props) {
			const styles = {
				'background-color': props.attributes.backgroundColor
			};
			const attrs  = {
				'data-ikol-contact': true,
				'data-acquisition': props.attributes.acquisition,
			};

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

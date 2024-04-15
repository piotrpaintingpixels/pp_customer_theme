wp.domReady(() => {

    wp.blocks.registerBlockStyle('core/latest-posts', [
        {
            name: 'default',
            label: 'Default',
            isDefault: true,
        },
        {
            name: 'card',
            label: 'Card',
        }
    ]);

    wp.blocks.registerBlockStyle('atomic-blocks/ab-post-grid', [{
    		name: 'default',
    		label: 'Default',
    		isDefault: true,
    	},
    	{
    		name: 'card',
    		label: 'Card',
    	}
    ]);

});
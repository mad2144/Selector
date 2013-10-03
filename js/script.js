var locked = false;
function expand(obj){
	if (!locked && obj.hasClassName('closed')) {
		locked = true;
		var element = $$('.open')[0];
		new Effect.Parallel([
			new Effect.Morph(element, {
				style: 'width:100px;',
				sync: true,
				transition:  Effect.Transitions.sinoidal,
				afterFinish: function() {
					locked = false;
				}
			}),
			new Effect.Fade(element.select('.inner')[0])
			]);
		element.removeClassName('open').addClassName('closed');
		
		new Effect.Parallel([
			new Effect.Morph(obj, {
				style: 'width:400px;',
				sync: true,
				transition:  Effect.Transitions.sinoidal, 
				afterFinish: function() {
					locked = false;	
				}
			}), 
			new Effect.Appear(obj.select('.inner')[0])
			]);
		
		obj.removeClassName('closed').addClassName('open');
	}
}
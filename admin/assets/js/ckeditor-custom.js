ClassicEditor.create( document.querySelector( '.editor' ), {
				
				toolbar: {
					items: [
						'heading',
						'|',
						'CKFinder',
						'bold',
						'italic',
						'link',
						'bulletedList',
						'numberedList',
						'|',
						'indent',
						'outdent',
						'|',
						'insertTable',
						'undo',
						'redo',
						'mediaEmbed',
						'comment',
						'code',
						'fontSize',
						'MathType',
						'imageUpload',
						'blockQuote',
						'codeBlock',
						'highlight',
						'fontFamily',
						'fontColor',
						'horizontalLine'
					]
				},
				language: 'en',
				image: {
					toolbar: [
						'imageTextAlternative',
						'imageStyle:full',
						'imageStyle:side'
					]
				},
				table: {
					contentToolbar: [
						'tableColumn',
						'tableRow',
						'mergeTableCells'
					]
				},
				licenseKey: '',
				sidebar: {
				container: document.querySelector( '.sidebar' )
			},
			} )
			.then( editor => {
				window.editor = editor;
		
				
				
				
			} )
			.catch( error => {
				console.error( error );
			} );
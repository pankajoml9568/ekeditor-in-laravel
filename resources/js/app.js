require('./bootstrap');


// <----------------------- Start custom JS --------------------------->


// import ClassicEditor from '@ckeditor/ckeditor5-build-classic/build/ckeditor';

import ClassicEditor from '@ckeditor/ckeditor5-editor-classic/src/classiceditor';
import Essentials from '@ckeditor/ckeditor5-essentials/src/essentials';
import Paragraph from '@ckeditor/ckeditor5-paragraph/src/paragraph';
import Bold from '@ckeditor/ckeditor5-basic-styles/src/bold';
import Italic from '@ckeditor/ckeditor5-basic-styles/src/italic';

var ready = (callback) => {
    if (document.readyState != "loading") callback();
    else document.addEventListener("DOMContentLoaded", callback);
  }

ready(() => { 

    ClassicEditor
        .create(document.querySelector('#ckEditor1'), {
            plugins: [Essentials, Paragraph, Bold, Italic],
            toolbar: ['bold', 'italic']
        })
        .then(editor => {
            console.log('Editor was initialized', editor);
        })
        .catch(error => {
            console.error(error.stack);
        });
});
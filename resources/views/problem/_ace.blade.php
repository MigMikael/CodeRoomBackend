<script src="{{ URL::asset('CodeRoom/js/lib/ace-builds/src-noconflict/ace.js') }}" type="text/javascript" charset="utf-8"></script>
<script>
    var editor = ace.edit("code");
    var textarea = $('textarea[name="code"]').hide();
    editor.getSession().setValue(textarea.val());
    editor.getSession().on('change', function(){
        textarea.val(editor.getSession().getValue());
    });
    editor.setTheme("ace/theme/eclipse");
    editor.getSession().setMode("ace/mode/java");
</script>
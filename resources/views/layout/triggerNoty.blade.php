@if (session("error")||session("success"))
<script>
new Noty({
type: "{{session("error")?"error":"info"}}",
layout: "centerRight",
text     : "{{session("error")?session("error"):session("success")}}",
timeout: 3000,
killer: true,
}).show();
</script>
@endif

{* template block that adds Google Analytics related fields *}
<div>{$form.gcid.html}</div>
{literal}
<script type="text/javascript">
  function _uGC(l, n, s) {
    if (!l || l == "" || !n || n == "" || !s || s == "") return "-";
    var i, i2, i3, c = "-";
    i = l.indexOf(n);
    i3 = n.indexOf("=") + 1;
    if (i > -1) {
      i2 = l.indexOf(s, i);
      if (i2 < 0) { i2 = l.length; }
      c = l.substring((i + i3), i2);
    }
    return c;
  }

var uaGaCkVal = _uGC(document.cookie, '_ga=', ';');
var uaGaCkValArray = uaGaCkVal.split('.');
var uaUIDVal = "";
var gacid = "";
if (uaGaCkValArray.length == 4) {
  uaUIDVal = uaGaCkValArray[2] + "." + uaGaCkValArray[3];
} else {
  uaUIDVal = "";
}
gcidField = document.querySelector("input[name='gcid']");
gcidField.value = uaUIDVal;
</script>
{/literal}

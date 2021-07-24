<table>
    <tr>
        <td width="70px">
          <img src="{{asset(env('APP_LOGO'))}}" width="50px" height="50px" >
        </td>
        <td width="850px">
          <table width="100%">
            <tr>
              <td>
                <font size="15" style="font-weight:bold;">{{isset($report_title) ? $report_title : ''}}</font>
              </td>
            </tr>
            <tr><td>&nbsp;&nbsp;{{isset($subtitle) ? $subtitle : ''}}</td></tr>
            <tr><td>&nbsp;&nbsp;Address : {{env('APP_ADDRESS')}}</td></tr>
          </table>
        </td>
    </tr>
    
</table>

      
      
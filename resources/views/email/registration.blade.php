<table>
<tr>
        <td style="text-align:left;font-size: 14px;">
                Dear <b>{{$user['name']}}</b>,<br>
                You have registered successfully.<br>Username:- <b>{{$user['mobile']}}</b> or <b>{{$user['email']}}</b><br> Password:- <b>{{$user['password']}}</b><br><br>
               @include('email.footer')  
        </td>
</tr>        
</table>
<%@ page import="db.User" %>
<% User userOnline = (User) session.getAttribute("CURRENT_USER");

    Boolean ONLINE = false;
    if(userOnline!=null){
        ONLINE=true;
    }
    %>
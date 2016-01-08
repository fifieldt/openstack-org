    $SetCurrentTab(8)
    <% require themedCSS(profile-section) %>
    <h1>$Title</h1>
    <% if CurrentMember %>
        <% include CurrentUserInfoBox LogOutLink=$Top.LogoutUrl, ResignLink=$Top.ResignUrl %>
        <% include ProfileNav %>
        <% if $Top.ActiveSummit %>
            <h2>$Top.ActiveSummit.Title Summit Attendee Registration Info</h2>
            $SummitAttendeeInfoForm
        <% else %>
            <p>There is not current summit yet!</p>
        <% end_if %>

    <% else %>
        <p>In order to edit your community profile, you will first need to
            <a href="/Security/login/?BackURL=%2Fprofile%2F">login as a member</a>. Don't have an account?
            <a href="/join/">Join The Foundation</a>
        </p>
        <p>
            <a class="roundedButton" href="/Security/login/?BackURL=%2Fprofile%2F">Login</a>
            <a href="/join/" class="roundedButton">Join The Foundation</a>
        </p>
    <% end_if %>
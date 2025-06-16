<form action="{{ url('/send-otp') }}" method="POST">
    @csrf
    <label>Mobile Number:</label>
    <input type="text" name="mobile"  placeholder="e.g., 918053615639">
    
    <label>OTP:</label>
    <input type="text" name="otp"  placeholder="e.g., 123456">
    
    <button type="submit">Send OTP via WhatsApp</button>
</form>

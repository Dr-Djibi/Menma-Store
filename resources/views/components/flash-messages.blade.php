@if(session('success'))
    <div class="flash-message success">
        <i class="fas fa-check-circle"></i> {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="flash-message error">
        <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
    </div>
@endif

<style>
.flash-message {
    position: fixed;
    top: 20px;
    right: 20px;
    padding: 15px 25px;
    border-radius: 8px;
    color: white;
    z-index: 9999;
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    display: flex;
    align-items: center;
    gap: 12px;
    animation: slideIn 0.3s ease-out forwards, fadeOut 0.5s ease-in 4s forwards;
}
.flash-message.success {
    background: #48bb78;
}
.flash-message.error {
    background: #f56565;
}
@keyframes slideIn {
    from { transform: translateX(100%); opacity: 0; }
    to { transform: translateX(0); opacity: 1; }
}
@keyframes fadeOut {
    from { opacity: 1; }
    to { opacity: 0; visibility: hidden; }
}
</style>

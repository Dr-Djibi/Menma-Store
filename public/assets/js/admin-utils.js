/**
 * Utilitaires pour le panneau d'administration
 */

document.addEventListener('DOMContentLoaded', function() {
    function attachCopy(btn) {
        if (!btn) return;
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const url = window.location.origin + (window.location.pathname.includes('/admin/') ? '/..' : '') + '/index.php';
            navigator.clipboard.writeText(url).then(function() {
                const originalHTML = btn.innerHTML;
                btn.classList.add('copied');
                btn.innerHTML = '<i class="fas fa-check"></i> Lien copié!';
                setTimeout(function() {
                    btn.classList.remove('copied');
                    btn.innerHTML = originalHTML;
                }, 2000);
            }).catch(function(err) {
                console.error('Erreur lors de la copie:', err);
            });
        });
    }

    attachCopy(document.getElementById('copyLinkBtn'));
    attachCopy(document.getElementById('copyMenuLinkBtn'));
});
window.updatePreview = function(input, targetId) {
    const preview = document.getElementById(targetId);
    if (preview) {
        if (input.value) {
            preview.src = input.value;
            preview.style.display = 'block';
        } else {
            preview.style.display = 'none';
        }
    }
};

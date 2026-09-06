const modalFor = { upload: 'upload-modal', review: 'review-modal', 'new-agent': 'new-agent-modal', connect: 'connect-modal' };

export function openModal(id) { document.getElementById(id)?.classList.add('active'); }
export function closeModal(overlay) { (overlay.closest?.('.modal-overlay') || overlay).classList.remove('active'); }

function loadReviewDraft(element) {
    const title = document.getElementById('review-title');
    const caption = document.getElementById('review-caption');
    const hashtags = document.getElementById('review-hashtags');
    const form = document.getElementById('review-form');

    if (title) title.textContent = element.dataset.title || 'Content review';
    if (caption) caption.value = element.dataset.caption || '';
    if (hashtags) hashtags.value = element.dataset.hashtags || '';
    if (form) form.action = '/content/' + element.dataset.contentId;
}

export function initModals() {
    document.querySelectorAll('[data-action]').forEach(element => {
        const action = element.dataset.action;
        if (modalFor[action]) element.addEventListener('click', () => openModal(modalFor[action]));
        if (action === 'review') {
            element.addEventListener('click', () => {
                loadReviewDraft(element);
                openModal('review-modal');
            });
        }
        if (action === 'generate') {
            element.addEventListener('click', () => {
                closeModal(element);
                alert('AI is writing a caption and hashtags for your uploaded media.');
            });
        }
        if (action === 'publish') {
            element.addEventListener('click', () => {
                closeModal(element);
                alert('Content published successfully.');
            });
        }
        if (action === 'create-agent') element.addEventListener('click', () => { closeModal(element); alert('Your new agent has been created and is ready for uploads.'); });
        if (action === 'connect-submit') element.addEventListener('click', () => { closeModal(element); alert('Account connection started. It will appear under Connected accounts once authorization completes.'); });
        if (action === 'manage') element.addEventListener('click', () => alert('Connected account settings are ready to manage.'));
        if (action === 'logout') element.addEventListener('click', () => { if (confirm('Log out of AgentHub on this device?')) alert('You have been logged out.'); });
    });

    document.querySelectorAll('.modal-overlay').forEach(overlay => {
        overlay.addEventListener('click', event => {
            if (event.target === overlay) overlay.classList.remove('active');
        });
        overlay.querySelectorAll('[data-close]').forEach(close => close.addEventListener('click', () => closeModal(overlay)));
    });
}

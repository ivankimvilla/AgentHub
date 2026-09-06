import './bootstrap';
import { initNavigation } from './agenthub/navigation';
import { initModals } from './agenthub/modals';
import { initInteractions } from './agenthub/interactions';
import { initAgents } from './agenthub/agents';
import { initSchedule } from './agenthub/schedule';
import { initQueue } from './agenthub/queue';
import { initPlatformPages } from './agenthub/platform';
import { initConnections } from './agenthub/connections';
import { initSettings } from './agenthub/settings';
import { initAccount } from './agenthub/account';

document.addEventListener('DOMContentLoaded', () => {
    initNavigation();
    initModals();
    initInteractions();
    initAgents();
    initSchedule();
    initQueue();
    initPlatformPages();
    initConnections();
    initSettings();
    initAccount();
});

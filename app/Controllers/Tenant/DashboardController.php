<?php

namespace App\Controllers\Tenant;

use App\Controllers\BaseController;
use App\Models\WaInstanceModel;
use App\Models\MessageQueueModel;

/**
 * Dashboard Controller untuk tenant
 */
class DashboardController extends BaseController
{
    protected WaInstanceModel $instanceModel;
    protected MessageQueueModel $queueModel;
    
    public function __construct()
    {
        $this->instanceModel = new WaInstanceModel();
        $this->queueModel = new MessageQueueModel();
    }
    
    /**
     * Tampilkan dashboard tenant
     */
    public function index()
    {
        $tenantId = session()->get('tenant_id');
        
        // Statistik overview
        $data['total_instances'] = $this->instanceModel
            ->where('tenant_id', $tenantId)
            ->countAllResults();
        
        $data['active_instances'] = $this->instanceModel
            ->where('tenant_id', $tenantId)
            ->where('status', 'connected')
            ->countAllResults();
        
        $data['pending_messages'] = $this->queueModel
            ->where('tenant_id', $tenantId)
            ->whereIn('status', ['pending', 'queued'])
            ->countAllResults();
        
        $data['sent_messages'] = $this->queueModel
            ->where('tenant_id', $tenantId)
            ->where('status', 'sent')
            ->whereDate('created_at', date('Y-m-d'))
            ->countAllResults();
        
        // Recent instances
        $data['recent_instances'] = $this->instanceModel
            ->where('tenant_id', $tenantId)
            ->orderBy('updated_at', 'DESC')
            ->findAll(5);
        
        // Recent messages
        $data['recent_messages'] = $this->queueModel
            ->where('tenant_id', $tenantId)
            ->orderBy('created_at', 'DESC')
            ->findAll(10);
        
        $data['title'] = 'Dashboard';
        $data['page_title'] = 'Dashboard Overview';
        
        return view('tenant/dashboard', $data);
    }
}

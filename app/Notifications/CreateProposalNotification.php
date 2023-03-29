<?php

namespace App\Notifications;

use App\Models\Project;
use App\Models\Proposal;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CreateProposalNotification extends Notification
{
    use Queueable;
    protected $freelanser;
    protected $proposal;

    /**
     * Create a new notification instance.
     */
    public function __construct(User $freelanser, Proposal $proposal)
    {
        $this->freelanser = $freelanser;
        $this->proposal = $proposal;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        $via = ['database','mail','broadcast'];
        if ($notifiable->notify_mail) {
            return $via[] = 'mail';
        }
        if ($notifiable->notify_sms) {
            return $via[] = 'nexmo';
        }
        return $via;
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $body = sprintf(
            '%s applied for a job %s',
            $this->freelanser->name,
            $this->proposal->project->name,
        );
        $message=new MailMessage();
        $message->subject('New Proposal')//رسالة ترحيب
                     ->from('notification@localhost','freelanser Website Notifications')
                     ->greeting('Hello' . $notifiable->name)
                     ->line($body)
                     ->action('View to Proposal' ,  route('project.show',$this->proposal->project_id))
                     ->line('Thank you for using our application ! ');
       return $message;
    }

      /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toDatabase(object $notifiable): array
    {
        $body = sprintf(
            '%s applied for a job %s',
            $this->freelanser->name,
            $this->proposal->project->name,
        );

        return [
            'title' => 'New Proposal',
            'body' => $body,
            'icon' => 'icon-mererial-outline-group',
            'route' => route('project.show', $this->proposal->project_id),
        ];
    }

    public function toBroadcast(object $notifiable): array
    {
        $body = sprintf(
            '%s applied for a job %s',
            $this->freelanser->name,
            $this->proposal->project->name,
        );

        return[
            'title' => 'New Proposal',
            'body' => $body,
            'icon' => 'icon-mererial-outline-group',
            'route' => route('project.show', $this->proposal->project_id),
        ];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        $body = sprintf(
            '%s applied for a job %s',
            $this->freelanser->name,
            $this->proposal->project->name,
        );

        return [
            'title' => 'New Proposal',
            'body' => $body,
            'icon' => 'icon-mererial-outline-group',
            'route' => route('project.show', $this->proposal->project_id),
        ];
    }
}

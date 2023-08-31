<?php

namespace App\Console\Commands;
use App\Models\Employee;
use Illuminate\Console\Command;

class CheckContractExpiration extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'contracts:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'make a verification about the contracts and exams are close to the expiration date';

    public function __contruct(){
        parent::__construct();
    }
    
    /**
     * Execute the console command.
     *
     * @return int
     */
    
    public function handle()
    {
        $employees = Employee::all(); 
        foreach ($employees as $employee) {
           $expirationExamDate = \Carbon\Carbon::parse($employee->exam_expiration);
           $expirationContractDate = \Carbon\Carbon::parse($employee->contract_expiration); 
           $daysUntilExamExpiration = now()->diffInDays($expirationExamDate, false); 
           $daysUntilContractExpiration = now()->diffInDays($expirationContractDate, false); 
       
           if($daysUntilExamExpiration <= 5){
               $this->info("El Exámen médico de {$employee->name} Vence en {$daysUntilExamExpiration} días"); 
           }
           
           if($daysUntilContractExpiration <= 5){
               $this->info("El contrato de {$employee->name} Vence en {$daysUntilContractExpiration} días"); 
           }
        }
    }
    /*
    $expirationExamDate = $employee->exam_expiration;
            $expirationContractDate = $employee->contract_expiration;
            */
       // }
  //  } 
        }  
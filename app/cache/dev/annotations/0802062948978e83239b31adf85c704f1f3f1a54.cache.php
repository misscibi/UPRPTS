<?php return unserialize('a:2:{i:0;O:26:"Doctrine\\ORM\\Mapping\\Table":5:{s:4:"name";s:26:"accepted_projects_in_phase";s:6:"schema";N;s:7:"indexes";a:2:{i:0;O:26:"Doctrine\\ORM\\Mapping\\Index":2:{s:4:"name";s:42:"fk_Accepted_Projects_In_Phase_Project1_idx";s:7:"columns";a:1:{i:0;s:10:"project_ID";}}i:1;O:26:"Doctrine\\ORM\\Mapping\\Index":2:{s:4:"name";s:20:"IDX_4C173F5F28CD4E38";s:7:"columns";a:1:{i:0;s:17:"phase_instance_ID";}}}s:17:"uniqueConstraints";a:1:{i:0;O:37:"Doctrine\\ORM\\Mapping\\UniqueConstraint":2:{s:4:"name";s:24:"phase_instance_ID_UNIQUE";s:7:"columns";a:2:{i:0;s:17:"phase_instance_ID";i:1;s:10:"project_ID";}}}s:7:"options";a:0:{}}i:1;O:27:"Doctrine\\ORM\\Mapping\\Entity":2:{s:15:"repositoryClass";N;s:8:"readOnly";b:0;}}');
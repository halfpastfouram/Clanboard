<?php
return array(
	'controllers'	=> array(
		'factories'	=> array(
			'Blog\Controller\List'	=> 'Blog\Factory\ListControllerFactory',
			'Blog\Controller\Post'	=> 'Blog\Factory\PostControllerFactory',
		)
	),

	'router'	=> array(
		'routes'	=> array(
			'blog_home'		=> array(
				'type'		=> 'literal',
				'options'	=> array(
					'route'		=> '/blog',
					'defaults'	=> array(
						'controller'	=> 'Blog\Controller\List',
						'action'		=> 'index',
					)
				)
			), 'blog'	=> array(
				'type'		=> 'segment',
				'options'	=> array(
					'route'    		=> '/blog[/:action][/:id]',
					'constraints'	=> array(
						'controller'	=> '[a-zA-Z][a-zA-Z0-9_-]*',
						'action'		=> '[a-zA-Z][a-zA-Z0-9_-]*',
						'id'			=> '[0-9]',
					), 'defaults'	=> array(
						'controller'	=> 'Blog\Controller\List',
						'action'     	=> 'index',
					)
				)
			), 'categories'	=> array(
				'type'		=> 'literal',
				'options'	=> array(
					'route'		=> '/blog/categories',
					'defaults'	=> array(
						'controller'	=> 'Blog\Controller\List',
						'action'		=> 'categories',
					)
				)
			), 'post'	=> array(
				'type'		=> 'segment',
				'options'	=> array(
					'route'			=> '/blog/post[/:id]',
					'contraints'	=>	array(
						'id'			=> '[0-9]',
					), 'defaults'	=> array(
						'controller'	=> 'Blog\Controller\Post',
						'action'		=> 'index',
					)
				)
			)
		)
	),

	'view_manager'	=> array(
		'template_path_stack'	=> array(
			__DIR__ . '/../view',
		)
	),

	'service_manager'	=> array(
		'factories'	=> array(
			'Blog\Model\CategoryTable'				=> 'Blog\Factory\CategoryTableFactory',
			'Blog\Model\CategoryTableGateway'		=> 'Blog\Factory\CategoryTableGatewayFactory',
			'Blog\Mapper\CategoryMapperInterface'	=> 'Blog\Factory\CategoryZendDbSqlMapperFactory',
			'Blog\Mapper\PostMapperInterface'		=> 'Blog\Factory\PostZendDbSqlMapperFactory',
			'Blog\Service\CategoryServiceInterface'	=> 'Blog\Factory\CategoryServiceFactory',
			'Blog\Service\PostServiceInterface'		=> 'Blog\Factory\PostServiceFactory',
		)
	),
);
<?php

require_once dirname( __DIR__ ) . '/abstract-testcase.php';

/**
 * Defines a basic fixture to run multiple tests.
 *
 * Resets the state of the WordPress installation before and after every test.
 *
 * Includes utility functions and assertions useful for testing WordPress.
 *
 * All WordPress unit tests should inherit from this class.
 */
class WP_UnitTestCase extends WP_UnitTestCase_Base {

	/**
	 * Asserts that two variables are equal (with delta).
	 *
	 * This method has been backported from a more recent PHPUnit version,
	 * as tests running on PHP 5.6 use PHPUnit 5.7.x.
	 *
	 * @since 5.6.0
	 *
	 * @param mixed  $expected First value to compare.
	 * @param mixed  $actual   Second value to compare.
	 * @param float  $delta    Allowed numerical distance between two values to consider them equal.
	 * @param string $message  Optional. Message to display when the assertion fails.
	 *
	 * @throws ExpectationFailedException
	 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
	 */
	public static function assertEqualsWithDelta( $expected, $actual, float $delta, string $message = '' ): void {
		$constraint = new PHPUnit\Framework\Constraint\IsEqual(
			$expected,
			$delta
		);

		static::assertThat( $actual, $constraint, $message );
	}

	/**
	 * Returns a mock object for the specified abstract class with all abstract
	 * methods of the class mocked. Concrete methods to mock can be specified with
	 * the last parameter.
	 *
	 * @since 5.6.0
	 *
	 * @param string $original_class_name
	 * @param string $mock_class_name
	 * @param bool   $call_original_constructor
	 * @param bool   $call_original_clone
	 * @param bool   $call_autoload
	 * @param array  $mocked_methods
	 * @param bool   $clone_arguments
	 *
	 * @throws \ReflectionException
	 * @throws RuntimeException
	 * @throws Exception
	 *
	 * @return MockObject
	 */
	public function getMockForAbstractClass( $original_class_name, array $arguments = array(), $mock_class_name = '', $call_original_constructor = true, $call_original_clone = true, $call_autoload = true, $mocked_methods = array(), $clone_arguments = false ): PHPUnit\Framework\MockObject\MockObject {
		if ( PHP_VERSION_ID >= 80000 && version_compare( tests_get_phpunit_version(), '9.3', '<' ) ) {
			$this->markTestSkipped( 'Skip getMockForAbstractClass on PHP 8' );
		}

		return parent::getMockForAbstractClass( $original_class_name, $arguments, $mock_class_name, $call_original_constructor, $call_original_clone, $call_autoload, $mocked_methods, $clone_arguments );
		/*
		if ( ! \is_string( $originalClassName ) ) {
			throw InvalidArgumentHelper::factory( 1, 'string' );
		}

		if ( ! \is_string( $mockClassName ) ) {
			throw InvalidArgumentHelper::factory( 3, 'string' );
		}

		if ( \class_exists( $originalClassName, $callAutoload ) ||
			\interface_exists( $originalClassName, $callAutoload ) ) {
			$reflector = new ReflectionClass( $originalClassName );
			$methods   = $mockedMethods;

			foreach ( $reflector->getMethods() as $method ) {
				if ( $method->isAbstract() && ! \in_array( $method->getName(), $methods, true ) ) {
					$methods[] = $method->getName();
				}
			}

			if ( empty( $methods ) ) {
				$methods = null;
			}

			return $this->getMock(
				$originalClassName,
				$methods,
				$arguments,
				$mockClassName,
				$callOriginalConstructor,
				$callOriginalClone,
				$callAutoload,
				$cloneArguments
			);
		}

		throw new RuntimeException(
			\sprintf( 'Class "%s" does not exist.', $originalClassName )
		);
		*/
	}

	/**
	 * Returns a builder object to create mock objects using a fluent interface.
	 *
	 * @since 5.6.0
	 *
	 * @param string|string[] $class_name
	 */
	public function getMockBuilder( $class_name ): PHPUnit\Framework\MockObject\MockBuilder {
		if ( PHP_VERSION_ID >= 80000 && version_compare( tests_get_phpunit_version(), '9.3', '<' ) ) {
			$this->markTestSkipped( 'Skip getMockBuilder on PHP 8' );
		}

		return parent::getMockBuilder( $class_name );
		/*
		return new PHPUnit\Framework\MockObject\MockBuilder( $this, $class_name );
		*/
	}
}
